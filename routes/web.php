<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthorityRequestController;
use App\Http\Controllers\AuthorityController;
use App\Http\Controllers\AuthorityReportController;
use App\Http\Controllers\AuthorityAttendedController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminAssignmentController;
use App\Http\Controllers\AdminAuthorityRequestController;
use App\Http\Controllers\AdminUserController;

Route::get('/', fn() => view('welcome'));
Route::get('/login', fn() => redirect()->route('login'));

/* LOGIN */
Route::get('/Login', [LoginController::class, 'index'])->name('login');
Route::post('/Login', [LoginController::class, 'login'])->name('login.procesar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/* REGISTRO */
Route::get('/Registro', [RegisterController::class, 'create'])->name('register');
Route::post('/Rregistro', [RegisterController::class, 'store'])->name('register.store');

/* RUTAS PROTEGIDAS POR AUTH */
Route::middleware('auth')->group(function () {

    /* USUARIOS */
    Route::get('/menu', [ReportController::class, 'create'])->name('menu');
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
    Route::get('/mis-reportes', [ReportController::class, 'misReportes'])->name('mis.reportes');

    /* AUTORIDAD */
    Route::get('/perfil-autoridad', [AuthorityController::class, 'perfil'])->name('perfil.autoridad');

    Route::get('/menu_autoridad', function () {
        return redirect()->route('reportes.asignados');
    })->name('menu.autoridad');

    Route::get('/reportes-asignados', [AuthorityReportController::class, 'index'])
        ->name('reportes.asignados');

    Route::post('/autoridad/reportes/{id}/aceptar', [AuthorityReportController::class, 'aceptarReporte'])
        ->name('autoridad.reportes.aceptar');

    Route::post('/autoridad/reportes/{id}/rechazar', [AuthorityReportController::class, 'rechazarReporte'])
        ->name('autoridad.reportes.rechazar');

    Route::post('/autoridad/reportes/{id}/atender', [AuthorityReportController::class, 'marcarAtendido'])
        ->name('autoridad.reportes.atender');

    Route::get('/incendios-atendidos', [AuthorityAttendedController::class, 'index'])
        ->name('incendios.atendidos');

    /* SOLICITUD PARA SER AUTORIDAD */
    Route::get('/solicitud-autoridad', [AuthorityRequestController::class, 'create'])->name('solicitud.autoridad');
    Route::post('/solicitud-autoridad/store', [AuthorityRequestController::class, 'store'])->name('solicitud.autoridad.store');

    /* ADMINISTRADOR - REPORTES */
    Route::get('/menu_administradores', [AdminReportController::class, 'index'])
        ->name('menu_administradores');

    Route::get('/administradores/reportes', [AdminReportController::class, 'index'])
        ->name('admin.reportes');

    Route::post('/admin/reportes/{id}/asignar-proceso', [AdminReportController::class, 'asignarYMarcarEnProceso'])
        ->name('admin.reportes.asignar_proceso');

    /* ADMINISTRADOR - ASIGNACIONES */
    Route::get('/admin/asignaciones', [AdminAssignmentController::class, 'index'])
        ->name('admin.asignaciones');

    Route::post('/admin/asignaciones/{id}', [AdminAssignmentController::class, 'store'])
        ->name('admin.asignaciones.store');

    Route::put('/admin/asignaciones/{id}', [AdminAssignmentController::class, 'update'])
        ->name('admin.asignaciones.update');

    Route::delete('/admin/asignaciones/{id}/cancelar', [AdminAssignmentController::class, 'cancel'])
        ->name('admin.asignaciones.cancel');

    /* ADMINISTRADOR - OTRAS VISTAS */
    Route::get('/admin/solicitudes', [AdminAuthorityRequestController::class, 'index'])
        ->name('admin.solicitudes');

    Route::post('/admin/solicitudes/{id}/aprobar', [AdminAuthorityRequestController::class, 'approve'])
        ->name('admin.solicitudes.aprobar');

    Route::post('/admin/solicitudes/{id}/rechazar', [AdminAuthorityRequestController::class, 'reject'])
        ->name('admin.solicitudes.rechazar');

    Route::get('/admin/usuarios', [AdminUserController::class, 'index'])
        ->name('admin.usuarios');

    Route::delete('/admin/usuarios/{id}', [AdminUserController::class, 'destroy'])
        ->name('admin.usuarios.destroy');

    Route::get('/admin/audit', [App\Http\Controllers\AdminAuditController::class, 'index'])->name('admin.audit');
});




/*
Route::get('/Menu_admin', function () {
    return view('Menu_admin');
});

Route::get('/Reportes_admin', function () {
    return view('Reportes_admin');
});

Route::get('/Usuarios_registrados', function () {
    return view('Usuarios_registrados');
});

Route::get('/AsignarReportes', function () {
    return view('AsignarReportes');
});
*/
