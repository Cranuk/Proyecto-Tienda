function alerta_eliminar(id, dato){
    let tipo;
    if (dato == 1) {
        tipo = 'Categoria';
    }
    if (dato == 2) {
        tipo = 'Producto';
    }
    Swal.fire({
        title: 'Eliminar ' + tipo,
        text: "Esta accion es irreversible, esta seguro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed && dato == 1) {
                eliminar_categoria(id);
            }
            if(result.isConfirmed && dato == 2){
                eliminar_producto(id);
            }
        });
}

function eliminar_categoria(id){
    $.ajax({
        url: baseUrl + "categoria/eliminar&id=" + id,
        type: "GET",
        data: {id: id},
        success: function(){
            Swal.fire(
                'Accion exitosa',
                'La categoria a sido borrada',
                'success'
            ).then(() => {
                location.reload();
            })
        }
    })
}

function eliminar_producto(id){
    $.ajax({
        url: baseUrl + "producto/eliminar&id=" + id,
        type: "GET",
        data: {id: id},
        success: function(){
            Swal.fire(
                'Accion exitosa',
                'El producto a sido borrado',
                'success'
            ).then(() => {
                location.reload();
            })
        }
    })
}