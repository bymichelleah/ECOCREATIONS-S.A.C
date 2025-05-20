<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class Carrito extends Component
{
    protected $listeners = ['agregarAlCarrito'];
    public $pro = [];

    public function mount()
    {
        $this->pro = session("carrito", []);
    }

    public function agregarAlCarrito($id)
    {
        $carrito_sesion = session("carrito", []);

        if ($carrito_sesion[$id] ?? null) {
            $carrito_sesion[$id]['cantidad']++;
        } else {
            $producto = Producto::findOrFail($id);
            $carrito_sesion[$id] = [
                'url_imagen' => $producto->url_imagen,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'precio' => $producto->precio,
                'cantidad' => 1
            ];
        }

        session(["carrito" => $carrito_sesion]);
        $this->pro = $carrito_sesion;
    }

    public function aumentarCantidad($id)
    {
        $carrito = session("carrito", []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
            session(['carrito' => $carrito]);
            $this->pro = $carrito;
        }
    }

    public function disminuirCantidad($id)
    {
        $carrito = session("carrito", []);
        if (isset($carrito[$id]) && $carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
            session(['carrito' => $carrito]);
            $this->pro = $carrito;
        }
    }

    public function render()
    {
        return view('livewire.carrito');
    }
}
