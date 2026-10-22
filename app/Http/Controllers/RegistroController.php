<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function create()
    {
        return view('auth.register'); // Asegúrate de tener la vista en resources/views/auth/register.blade.php
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ], [], [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ]);

        // Crear el usuario en la base de datos
        $user = User::create([
            ...$datos,
            'rol' => User::ROL_USUARIO,
        ]);

        // Iniciar sesión automáticamente después de registrarse
        Auth::login($user);

        // Redirigir al listado de cursos con un mensaje de éxito
        return redirect()->route('curso.index')
            ->with('success', '¡Cuenta creada con éxito! Bienvenido(a) '.$user->name.'.');
    }
}
