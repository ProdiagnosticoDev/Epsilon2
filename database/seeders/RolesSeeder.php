<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'Gestion Documental',
            'Cuadro de Turnos',
            'RIS',
            'Solicitudes',
            'Talento Humano',
            'Equipos',
            'Reportes',
            'Estadisticas',
            'Gestion de usuarios',
            'Configuracion del Sistema',
            'Encuestas',
            'Facturacion',
            'Produccion',
            'Monitoreo Contraste',
            'Cuadro de Convenciones',
            'Registro de Avales',
            'Aprobacion de Avales',
            'Reporte Avales',
            'Generacion de PDF por servicio',
            'Consulta y eliminacion de ausentismo',
            'Registro de ausentismo',
            'Configuración Avales',
            'Configuración Avanzada del Sistema',
            'Reporte general avales',
            'Envio PDFs por FTP',
            'Comunicación Agendas',
            'Especialistas Agendas',
            'Administracion Agendas',
            'Auditoria',
            'Registros Asistenciales',
            'Registro Insumos',
            'Registro Insumos Facturables',
            'Administración Eventos Adversos',
            'Registro contraste',
            'Registro sedacion',
            'Encuesta Caídas',
            'Entrega de turnos',
            'Arqueo medio de contraste',
        ];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }
    }
}
