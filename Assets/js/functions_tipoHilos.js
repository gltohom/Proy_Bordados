var tableTipoHilos;

document.addEventListener('DOMContentLoaded', function()
{
    tableTipoHilos = $('#tableTipoHilos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/TipoHilos/getTipoHilos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idTipoHilo" },
            { "data": "tipo" },
            { "data": "actualizar" },
            { "data": "eliminar" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            }
        ],      
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    //nuevo Tipo de hilo y validacion de campos
    var formTipoHilo = document.querySelector("#formTipoHilo");
    formTipoHilo.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdTipoHilo = document.querySelector('#idTipoHilo').value;
        var strTipo = document.querySelector('#txtNombreTipoHilos').value;
        if(strTipo == '') 
        {
            swal("Atención", "Debe llenar todos los campos." , "error");
            return false;
        }

        //para validar si se estan cumpliendo las funciones de los datos validos ingresados en los formularios
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) 
        { 
            if(elementsValid[i].classList.contains('is-invalid')) 
            { 
                swal("Atención", "Verifique los campos." , "error");
                return false;
            } 
        } 
        //capturando datos por medio de ajax
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/TipoHilos/setTipoHilo';
        var formData = new FormData(formTipoHilo);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function()
        {
            if (request.readyState == 4 && request.status == 200) 
            {
                var objData = JSON.parse(request.responseText);
                if(objData.estado)
                {
                    //para volver a cargar los datos en los formularios despues de un nuevo ingreso

                    $('#modalFormTipoHilos').modal("hide");
                    formTipoHilo.reset();
                    swal("Tipos de hilos", objData.msg ,"success");
                    tableTipoHilos.api().ajax.reload(function()
                    {
                        /*fntActualizarTipoHilo();
                        fntEliminarTipoHilo();*/
                    });
                }
                else
                {
                    swal("Error", objData.msg , "error");  
                }
            }
        }
    }
});

//id de datatables
$('#tableTipoHilos').DataTable();


function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idTipoHilo').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de nuevo tipo";
    document.querySelector('#formTipoHilo').reset();

    $('#modalFromTipoHilos').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    
}, false);

//para asignar la funcion a todos los id btnActualizarTipoHilo
function fntActualizarTipoHilo(idTipoHilo)
{
    
    document.querySelector('#tituloModal').innerHTML = "Actualizar Tipo";
    document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTexto').innerHTML = "Actualizar";

    //Mostrar datos en formulario
    var idtipoHilo = idTipoHilo;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/TipoHilos/getTipoHilo/'+idtipoHilo;
    request.open("GET", ajaxUrl, true);
    request.send();

    //para obtener la respuesta a la peticion
    request.onreadystatechange = function()
    {
        if (request.readyState == 4 && request.status == 200) 
        {
            var objData = JSON.parse(request.responseText);

            //validar los datos a mostrar
            if (objData.status) 
            {
                document.querySelector('#idTipoHilo').value = objData.data.idTipoHilo;
                document.querySelector('#txtNombreTipoHilos').value =objData.data.tipo;

                $('#modalFromTipoHilos').modal('show');

            }
            else
            {
                swal("Error", objData.msg , "error");
            }
        }
    }
}

//eliminar un tipo de hilo
function fntEliminarTipoHilo(idTipoHilo)
{
    var idtipoHilo = idTipoHilo;
    swal({
        title: "Eliminar tipo",
        text: "¿Seguro que quiere eliminar este tipo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) 
    {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/TipoHilos/eliminarTipoHilo/';
            var strData = "idTipoHilo="+idtipoHilo;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function()
            {
                if(request.readyState == 4 && request.status == 200)
                {
                    var objData = JSON.parse(request.responseText);
                    if(objData.estado)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableTipoHilos.api().ajax.reload(function()
                        {
                            /*fntActualizarTipoHilo();
                            fntEliminarTipoHilo();*/
                        });
                    }else
                    {
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}
