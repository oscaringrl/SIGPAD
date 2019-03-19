<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/getInfoDocente',
        '/getHistorial',
        '/getExperiencia',
        '/getCertificaciones',
        '/getSkills',
        '/getGeneralInfo',
        '/getListadoDocentes',
        '/getPostgrados', //Grupo 04
        '/getDiplomados',//GP04-2019
        '/getRepresentaciones' //Grupo 04


    ];
}
