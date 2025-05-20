<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // Aquí puedes validar y procesar los datos
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
            'terminos' => 'accepted',
             'g-recaptcha-response' => 'required' // validamos que se haya enviado
        ]);
         // Verificar el reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $data = $response->json();

        if (!$data['success']) {
            return back()->withErrors(['captcha' => 'ReCAPTCHA inválido. Por favor, intenta nuevamente.'])->withInput();
        }

        // Ejemplo: almacenar en base de datos, enviar email, etc.

        return back()->with('success', 'Gracias por tu consulta. Te responderemos pronto.');
    }
}

class InicioSesionController extends Controller
{
    public function enviar(Request $request)
    {
        // Aquí puedes validar y procesar los datos
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email',
            'contraseña' => 'required|',
        ]);

        // Ejemplo: almacenar en base de datos, enviar email, etc.

        return back()->with('success', 'Gracias por tu consulta. Te responderemos pronto.');
    }
}

abstract class Controller
{
    //
}