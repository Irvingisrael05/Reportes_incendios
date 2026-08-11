import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/welcome.css',
                'resources/css/login.css',
                'resources/css/registro.css',
                'resources/css/menu_administradores.css',
                'resources/css/menu_autoridades.css',
                'resources/css/menu_usuarios.css',
                'resources/css/reporte_usuarios.css',
                'resources/css/reportes_recibidos.css',
                'resources/css/reportes_asignados.css',
                'resources/css/asignar_reportes.css',
                'resources/css/incendios_atendidos.css',
                'resources/css/generar_reportes.css',
                'resources/css/solicitud_autoridades.css',
                'resources/css/solicitudes_recibidas.css',
                'resources/css/usuarios_registrados.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
