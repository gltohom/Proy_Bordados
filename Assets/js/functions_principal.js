


function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idDisenio').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de diseño";
    document.querySelector('#formDisenio').reset();

    $('#modalFromPrincipal').modal('show');
}

