const POST = () => {
    MasterFetch({
        url:    'obtener_impuestos_por_pais',
        method: 'POST',
        data : {
            pais_id: PAIS_ID
        },
        successFn : (response) => {
            if( response.exito ){

            }
        },
        errorFn : (response) => {
            // console.log('errorFn:') console.log({response})
        },
    })
}
const GET = (CLIENTE_PAIS_ID) => {
    MasterFetch({
        url:    'show_contactos_cliente/'+CLIENTE_PAIS_ID,
        method: 'GET',
        data: {},
        successFn : (response) => {

        },
        errorFn : (response) => {
            // console.log('errorFn:') //console.log({response})
        },
    })
}


let ARTICULO_ID = null;

const obtener_articulos = () => {
    MasterFetch({
        url:    'api/showArticulos/',
        method: 'GET',
        data: {},
        successFn : (response) => {
            dibujar_tabla_articulos(response.data)
        },
        errorFn : (response) => {
            // console.log('errorFn:') //console.log({response})
        },
    })
}
const dibujar_tabla_articulos = (data) => {
    const tbody = document.querySelector('#tablaArticulos').querySelector('tbody');

    let tmp = ``
    data.articulos.forEach(element => {
        tmp += `
            <tr data-articulo_id="${element.id}">
                <th scope="row">${element.id}</th>
                <td>${element.nombre}</td>
                <td>$${element.precio}</td>
                <td>${element.cantidad}</td>
                <td>
                    <button type="button" class="btn btn-danger btnBajaArticulo"><i
                            class="fa-regular fa-trash-can"></i></button>
                    <button type="button" class="btn btn-success btnEdicionArticulo"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-primary btnActualizacionArticulo"><i
                            class="fa-solid fa-plus"></i></button>
                </td>
            </tr>
        `
    });
    // tbody.append(tmp);
    tbody.innerHTML = tmp;


    
    $('.btnBajaArticulo').on("click", function(){
        ARTICULO_ID = $(this).closest('tr').data('articulo_id');
        baja_articulo();
    })
    $('.btnEdicionArticulo').on("click", function(){
        ARTICULO_ID = $(this).closest('tr').data('articulo_id');
        obtener_articulo(1);
    })
    $('.btnActualizacionArticulo').on("click", function(){
        ARTICULO_ID = $(this).closest('tr').data('articulo_id');
        obtener_articulo(2);
    })
}
const obtener_articulo = (tipo) => {
    // tipo
    MasterFetch({
        url:    'api/showArticulo/'+ARTICULO_ID,
        method: 'GET',
        data: {},
        successFn : (response) => {
            switch (tipo) {
                case 1:
                    document.querySelector('#nombre_articulo').innerHTML = response.data.articulo.nombre;
                    document.querySelector('#precio_actual').innerHTML = `$${response.data.articulo.precio}`;
                    document.querySelector('#nuevo_nombre').value = response.data.articulo.nombre;;
                    document.querySelector('#nuevo_precio').value = `${response.data.articulo.precio}`;;
                    $('#edicionArticuloModal').modal('show');
                break;
            
                case 2:
                    document.querySelector('#nombre_articulo2').innerHTML = response.data.articulo.nombre;
                    document.querySelector('#cantidad_actual').innerHTML = response.data.articulo.cantidad;
                    document.querySelector('#nueva_cantidad').value = response.data.articulo.cantidad;
                    $('#actualizacionArticuloModal').modal('show');
                break;

                // default: break;
            }
        },
        errorFn : (response) => {
            // console.log('errorFn:') //console.log({response})
        },
    })
}

const nuevo_articulo = () => {
    const data = {
        nombre:     document.querySelector('#nombre').value,
        precio:     document.querySelector('#precio').value,
        cantidad:   document.querySelector('#cantidad').value,
    }

    MasterFetch({
        url:    'api/nuevoArticulo',
        method: 'POST',
        data : data,
        successFn : (response) => {
            if( response.exito ){
                Swal.fire({
                    icon: 'success',
                    title: 'Artículo Guardado con Éxito!',
                    showConfirmButton: false,
                    timer: 1500
                })
                obtener_articulos();
                $('#nuevoArticuloModal').modal('hide');
            }
        },
        errorFn : (response) => {
            // console.log('errorFn:') console.log({response})
        },
    })
}
const baja_articulo = () => {
    Swal.fire({
        title: '¿Desea dar de baja del Artículo seleccionado?',
        showDenyButton: true,
        confirmButtonText: 'Si',
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                articulo_id: ARTICULO_ID,
            }
        
            MasterFetch({
                url:    'api/bajaArticulo',
                method: 'POST',
                data : data,
                successFn : (response) => {
                    if( response.exito ){
                        Swal.fire({
                            icon: 'success',
                            title: 'Baja del Artículo con Éxito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        obtener_articulos();
                        // $('#nuevoArticuloModal').modal('hide');
                    }
                },
                errorFn : (response) => {
                    // console.log('errorFn:') console.log({response})
                },
            })
        }
    })
}


const edicion_articulo = () => {
    const data = {
        articulo_id:  ARTICULO_ID,
        nuevo_nombre: document.querySelector('#nuevo_nombre').value,
        nuevo_precio: document.querySelector('#nuevo_precio').value,
    }

    MasterFetch({
        url:    'api/edicionArticulo',
        method: 'POST',
        data : data,
        successFn : (response) => {
            if( response.exito ){
                Swal.fire({
                    icon: 'success',
                    title: 'Edición del Artículo con Éxito!',
                    showConfirmButton: false,
                    timer: 1500
                })

                obtener_articulos();
                $('#edicionArticuloModal').modal('hide');
            }
        },
        errorFn : (response) => {
            // console.log('errorFn:') console.log({response})
        },
    })
}
const actualizacion_articulo = () => {
    const data = {
        articulo_id:  ARTICULO_ID,
        nueva_cantidad: document.querySelector('#nueva_cantidad').value,
    }

    MasterFetch({
        url:    'api/actualizacionArticulo',
        method: 'POST',
        data : data,
        successFn : (response) => {
            if( response.exito ){
                Swal.fire({
                    icon: 'success',
                    title: 'Actualización del Artículo con Éxito!',
                    showConfirmButton: false,
                    timer: 1500
                })
                obtener_articulos();
                $('#actualizacionArticuloModal').modal('hide');
            }
        },
        errorFn : (response) => {
            // console.log('errorFn:') console.log({response})
        },
    })
}


const nuevo_articulo_modal = () => {
    document.querySelector('#nombre').value = null
    document.querySelector('#precio').value = null
    document.querySelector('#cantidad').value = null
    $('#nuevoArticuloModal').modal('show');
}


document.addEventListener("DOMContentLoaded", function (event) {
    $('#btnNuevoArticuloModal').on("click", nuevo_articulo_modal)
    
    $('#btnGuardarNuevoArticulo').on("click", nuevo_articulo)
    $('#btnGuardarEdicionArticulo').on("click", edicion_articulo)
    $('#btnGuardarActualizacionArticulo').on("click", actualizacion_articulo)
    obtener_articulos();
});