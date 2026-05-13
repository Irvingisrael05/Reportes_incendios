<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcosystemModel;
use App\Models\CategoryModel;
use App\Models\ReportModel;
use App\Models\EvidenceModel;
use App\Models\WeatherModel;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create()
    {
        $ecosystems = EcosystemModel::orderBy('id_ecosystem', 'asc')->get();
        $categories = CategoryModel::orderBy('id_category', 'asc')->get();

        return view('usuarios.generar_reportes', compact('ecosystems', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'municipality' => 'required|string|max:100',
            'locality' => 'required|string|max:150',
            'ecosystem_id' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;

        $weatherService = new WeatherService();

        $weatherData = $weatherService->getWeatherByCoordinates($lat, $lng);

        if (!$weatherData) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'No se pudieron obtener los datos del clima. Intenta nuevamente.');
        }

        $weather = WeatherModel::create([
            'temperature' => $weatherData['temperature'],
            'humidity' => $weatherData['humidity'],
            'precipitation' => $weatherData['precipitation'],
            'wind_speed' => $weatherData['wind_speed'],
            'wind_direction' => $weatherData['wind_direction'],
            'atmospheric_pressure' => $weatherData['atmospheric_pressure'],
            'cloudiness' => $weatherData['cloudiness'],
            'record_date' => now()
        ]);

        $report = ReportModel::create([
            'user_id' => Auth::user()->id_user,
            'ecosystem_id' => $request->ecosystem_id,
            'category_id' => $request->category_id,
            'weather_id' => $weather->id_weather,
            'status_id' => 1,
            'latitude' => $lat,
            'longitude' => $lng,
            'municipality' => $request->municipality,
            'locality' => $request->locality,
            'description' => $request->description,
            'report_date' => now()
        ]);

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

    public function misReportes()
    {
        $reports = ReportModel::where('user_id', Auth::user()->id_user)
            ->with(['ecosystem', 'status', 'category'])
            ->orderBy('report_date', 'desc')
            ->get();

        return view('usuarios.reporte_usuarios', compact('reports'));
    }
}
