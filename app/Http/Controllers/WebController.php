<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Producto;

class WebController extends Controller
{
    public function home()
    {
        // Obtener productos destacados o recientes
        $productos = Producto::latest()->take(6)->get();
        
        return view('web.home', compact('productos'));
    }

    public function contacto()
    {
        return view('web.contacto');
    }

    public function productos()
    {
        $productos = Producto::paginate(12);
        
        return view('web.productos', compact('productos'));
    }

    public function productoDetalle($id)
    {
        $producto = Producto::findOrFail($id);
        
        return view('web.producto-detalle', compact('producto'));
    }

    public function enviarContacto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
            'acepta_politicas' => 'accepted'
        ]);

        // Aquí puedes enviar el email o guardar en base de datos
        // Por ejemplo, enviar email:
        /*
        Mail::raw($request->mensaje, function ($message) use ($request) {
            $message->from($request->email, $request->nombre)
                    ->to('admin@ferreteria.com')
                    ->subject('Nuevo mensaje de contacto');
        });
        */

        return back()->with('success', 'Mensaje enviado correctamente. Te contactaremos pronto.');
    }
}