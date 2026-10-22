<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RegistrarActividad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $inicio = microtime(true);

        $response = $next($request);


        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            Log::info('Actividad en cursos', [
                'usuario' => $request->user()?->email ?? 'invitado',
                'metodo'  => $request->method(),
                'ruta'    => $request->path(),
                'estado'  => $response->getStatusCode(),
                'ip'      => $request->ip(),
                'ms'      => round((microtime(true) - $inicio) * 1000, 2),
            ]);
        }

        return $response;
    }
}
