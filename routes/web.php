<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Login', function () {
    return view('Login');
});

Route::get('/Registro', function () {
    return view('Registro');
});

Route::get('/Reporte', function () {
    return view('Reporte');
});

Route::get('/Reportes_usuario', function () {
    return view('Reportes_usuario');
});

Route::get('/Menu_autoridades', function () {
    return view('Menu_autoridades');
});

Route::get('/Reportes_autoridades', function () {
    return view('Reportes_autoridades');
});

Route::get('/Incendios_atendidos', function () {
    return view('Incendios_atendidos');
});

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
