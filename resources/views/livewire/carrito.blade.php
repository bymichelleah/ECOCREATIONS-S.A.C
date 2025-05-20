<section class="productos-carrito">
    @if($pro)
    @foreach($pro as $id => $producto)
    <article class="product-añadido">
        <section class="product-insertado">
            <img src="{{ asset($producto['url_imagen'])}}" alt="">
            <div class="product-descrip">
                <p>{{$producto["nombre"]}}</p>
                <h3>{{$producto["descripcion"]}}</h3>
            </div>
        </section>
        <div class="product-precio">
            <h3>s/{{$producto["precio"]}}</h3>
            <h4>
                <button class="contador" wire:click="disminuirCantidad({{ $id }})">-</button>
                {{ $producto["cantidad"] }}
                <button class="contador" wire:click="aumentarCantidad({{ $id }})">+</button>
            </h4>
        </div>
    </article>
    @endforeach
    @else
    <div>No hay productos aún</div>
    @endif
</section>