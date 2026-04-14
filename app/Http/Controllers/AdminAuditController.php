<?php

namespace App\Http\Controllers;

use App\Models\AuditLogModel;
use Illuminate\Http\Request;

class AdminAuditController extends Controller
{
    public function index(Request $request)
    {
        // Obtener listado de tablas únicas para el filtro (opcional)
        $tablas = AuditLogModel::select('table_name')->distinct()->orderBy('table_name')->pluck('table_name');

        $logs = AuditLogModel::with('user')
            ->forTable($request->get('table'))
            ->forOperation($request->get('operation'))
            ->orderBy('created_at', 'desc')
            ->paginate(50)  // 50 registros por página
            ->appends($request->query()); // mantener filtros en paginación

        return view('administradores.audit_logs', compact('logs', 'tablas'));
    }
}