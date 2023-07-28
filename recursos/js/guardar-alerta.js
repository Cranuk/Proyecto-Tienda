// TODO: id = 0 crea nueva categoria / id > 0 editar una categoria
function alerta_categoria(id){
    event.preventDefault();
    let nombre = document.querySelector('#nombre').value;
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
    let categoria = document.querySelector('#categoria').value;
    let nombre = document.querySelector('#nombre').value;
    let descripcion = document.querySelector('#descripcion').value;
    let precio = document.querySelector('#precio').value;
    let stock = document.querySelector('#stock').value;
    let imagen = document.querySelector('#imagen').value;
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

    const formData = new FormData();
    formData.append('id', id);
    formData.append('categoria', categoria);
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('precio', precio);
    formData.append('stock', stock);
    formData.append('imagen', imagen); // Agregar la imagen al FormData

    $.ajax({
        url: baseUrl + direccion,
        type: "POST",
        data: formData, // Usar el objeto FormData como data
        contentType: false, // Importante: desactivar el contentType
        processData: false, // Importante: desactivar el processData
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
