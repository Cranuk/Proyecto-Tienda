function alerta_usuario() {
    event.preventDefault();
    let nombre = document.getElementById('nombreUsuario').value;
    let apellido = document.getElementById('apellidoUsuario').value;
    let correo = document.getElementById('correoUsuario').value;
    let clave = document.getElementById('claveUsuario').value;
    
    Swal.fire({
        title: 'Confirmar tus datos',
        text: "¿Desea guardar los datos ingresados?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí'
    }).then((result) => {
        if (result.isConfirmed) {
            guardar_usuario(nombre, apellido, correo, clave);
        }
    });
}

function guardar_usuario(nombre, apellido, correo, clave) {
    let direccion = 'usuario/guardar';

    $.ajax({
        url: baseUrl + direccion,
        type: "POST",
        data: {
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            clave: clave
        },
        success: function () {
            Swal.fire(
                'Exito',
                'Usuario registrado correctamente',
                'success'
            ).then(() => {
                location.reload();
            })
        }
    });
}

// TODO: id = 0 crea nueva categoria / id > 0 editar una categoria
function alerta_categoria(id){
    event.preventDefault();
    let nombre = document.getElementById('nombreCategoria').value;
    Swal.fire({
        title: 'Guardar la categoria?',
        text: "Desea guardar los datos ingresados?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                guardar_categoria(id, nombre);
            }
        });
}

function guardar_categoria(id, nombre){
    let direccion;
    if(id != 0){
        direccion = 'categoria/guardar&id='+ id;
    }else{
        direccion = 'categoria/guardar';
    }
    $.ajax({
        url: baseUrl + direccion,
        type: "POST",
        data: {
                id: id,
                nombre:nombre
                },
        success: function(){
            Swal.fire(
                'Accion exitosa',
                'La categoria a sido guardada',
                'success'
            ).then(() => {
                location.reload();
            })
        }
    })
}


function alerta_producto(id){
    event.preventDefault();
    let categoria = document.getElementById('categoriaProducto').value;
    let nombre = document.getElementById('nombreProducto').value;
    let descripcion = document.getElementById('descripcionProducto').value;
    let precio = document.getElementById('precioProducto').value;
    let stock = document.getElementById('stockProducto').value;
    let imagen = document.getElementById('imagenProducto').value;
    Swal.fire({
        title: 'Guardar el producto?',
        text: "Desea guardar los datos ingresados?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                guardar_producto(id, categoria, nombre, descripcion, precio, stock, imagen);
            }
        });
}

function guardar_producto(id, categoria, nombre, descripcion, precio, stock, imagen) {
    let direccion;
    if (id !== 0) {
        direccion = 'producto/guardar&id=' + id;
    } else {
        direccion = 'producto/guardar';
    }

    $.ajax({
        url: baseUrl + direccion,
        type: "POST",
        data: {
            id: id,
            categoria: categoria,
            nombre: nombre,
            descripcion: descripcion,
            precio: precio,
            stock: stock,
            imagen: imagen
        },
        success: function () {
            Swal.fire(
                'Accion exitosa',
                'El producto ha sido guardado',
                'success'
            ).then(() => {
                location.reload();
            })
        }
    });
}