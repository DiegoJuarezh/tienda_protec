<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="">
    <div class="container">
        <div class="pt-4">
            <div></div>
            <div class="mb-3">
                <h2>Artículos</h2>
            </div>

            <div class="mb-3">
                <!-- Button trigger modal -->
                <button type="button" id="btnNuevoArticuloModal" class="btn btn-primary" 
                    {{-- data-bs-toggle="modal" data-bs-target="#nuevoArticuloModal" --}}
                >
                    Nuevo Artículo
                </button>
            </div>
            <table class="table" id="tablaArticulos">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="nuevoArticuloModal" tabindex="-1" aria-labelledby="nuevoArticuloModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nuevoArticuloModalLabel">Nuevo Artículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" id="precio" name="precio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="text" id="cantidad" name="cantidad" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarNuevoArticulo">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edicionArticuloModal" tabindex="-1" aria-labelledby="edicionArticuloModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edicionArticuloModalLabel">Edición Artículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre_articulo" class="form-label mb-0">Nombre del Articulo</label>
                            <h4 id="nombre_articulo" name="nombre_articulo"></h4>
                        </div>
                        <div class="mb-3">
                            <label for="precio_actual" class="form-label mb-0">Precio Actual</label>
                            <h4 id="precio_actual" name="precio_actual"></h4>
                        </div>
                        <div class="mb-3">
                            <label for="nuevo_nombre" class="form-label">Nuevo Nombre</label>
                            <input type="text" id="nuevo_nombre" name="nuevo_nombre" class="form-control" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="nuevo_precio" class="form-label">Nuevo Precio</label>
                            <input type="text" id="nuevo_precio" name="nuevo_precio" class="form-control" value="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarEdicionArticulo">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actualizacionArticuloModal" tabindex="-1"
        aria-labelledby="actualizacionArticuloModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="actualizacionArticuloModalLabel">Actualización Artículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre_articulo2" class="form-label mb-0">Nombre del Articulo</label>
                            <h4 id="nombre_articulo2" name="nombre_articulo2"></h4>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_actual" class="form-label mb-0">Cantidad Actual</label>
                            <h4 id="cantidad_actual" name="cantidad_actual"></h4>
                        </div>
                        <div class="mb-3">
                            <label for="nueva_cantidad" class="form-label">Nueva Cantidad</label>
                            <input type="text" id="nueva_cantidad" name="nueva_cantidad" class="form-control" value="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarActualizacionArticulo">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script> const base_url = {!! json_encode( url('') ) !!}+'/'; </script>
    <script type="text/javascript" src="{{ asset('js/master.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/articulos.js') }}"></script>
</body>

</html>
