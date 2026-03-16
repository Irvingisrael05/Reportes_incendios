<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcosystemModel;
use App\Models\CategoryModel;
use App\Models\ReportStatusModel;
use App\Models\ReportModel;
use App\Models\EvidenceModel;
use App\Models\WeatherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{

    /**
     * Mostrar formulario de creación de reportes
     */
    public function create()
    {
        $ecosystems = EcosystemModel::all();
        $categories = CategoryModel::all();

        return view('usuarios.generar_reportes', compact('ecosystems', 'categories'));
    }


    /**
     * Guardar reporte
     */
    public function store(Request $request)
    {

        // Validación
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'ecosystem_id' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;

        /*
        1️⃣ Obtener clima desde API
        */

        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get(
            "https://api.openweathermap.org/data/2.5/weather",
            [
                'lat' => $lat,
                'lon' => $lng,
                'units' => 'metric',
                'appid' => $apiKey
            ]
        );

        $weatherData = $response->json();

        /*
        2️⃣ Guardar clima
        */

        $weather = WeatherModel::create([

            'temperature' => $weatherData['main']['temp'] ?? null,
            'humidity' => $weatherData['main']['humidity'] ?? null,
            'precipitation' => $weatherData['rain']['1h'] ?? 0,
            'wind_speed' => $weatherData['wind']['speed'] ?? null,
            'wind_direction' => $weatherData['wind']['deg'] ?? null,
            'atmospheric_pressure' => $weatherData['main']['pressure'] ?? null,
            'cloudiness' => $weatherData['clouds']['all'] ?? null,
            'record_date' => now()

        ]);


        /*
        3️⃣ Guardar reporte
        */

        $report = ReportModel::create([

            'user_id' => Auth::user()->id_user,

            'ecosystem_id' => $request->ecosystem_id,

            'weather_id' => $weather->id_weather,

            'status_id' => 1, // 1 = En proceso

            'latitude' => $lat,

            'longitude' => $lng,

            'description' => $request->description,

            'report_date' => now()

        ]);


        /*
        4️⃣ Guardar evidencia (foto)
        */

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('evidences', 'public');

            EvidenceModel::create([

                'report_id' => $report->id_report,

                'user_id' => Auth::user()->id_user,

                'category_id' => $request->category_id,

                'url' => $imagePath

            ]);
        }


        return redirect()->back()->with('success', 'Reporte generado correctamente.');

    }


    /**
     * Mostrar reportes del usuario logueado
     */
    public function misReportes()
    {

        $reports = ReportModel::where('user_id', Auth::user()->id_user)
            ->with(['ecosystem','status'])
            ->orderBy('report_date','desc')
            ->get();

        return view('usuarios.reporte_usuarios', compact('reports'));

    }

}
