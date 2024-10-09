var tableColores;

document.addEventListener('DOMContentLoaded', function()
{
    tableColores = $('#tableColores').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Colores/getColores",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idColor" },
            { "data": "color" },
            { "data": "descripción" },
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

    //nuevo Color y validacion de campos
    var formColor = document.querySelector("#formColor");
    formColor.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdColor = document.querySelector('#idColor').value;
        var strColor = document.querySelector('#txtNombreColores').value;
        var strDescripción = document.querySelector('#txtDescripciónColores').value;
        if(strColor == '') 
        {
            swal("Atención", "Debe llenar todos los campos obligatoios." , "error");
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
        var ajaxUrl = base_url+'/Colores/setColor';
        var formData = new FormData(formColor);
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

                    $('#modalFormColores').modal("hide");
                    formColor.reset();
                    swal("Colores", objData.msg ,"success");
                    tableColores.api().ajax.reload(function()
                    {
                        /*fntActualizarColor();
                        fntEliminarColor();*/
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
$('#tableColores').DataTable();

function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idColor').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de color";
    document.querySelector('#formColor').reset();

    $('#modalFromColores').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    /*fntActualizarColor();
    fntEliminarColor();*/
}, false);

//para asignar la funcion a todos los id btnActualizarTipoHilo
function fntActualizarColor(idColor)
{
    document.querySelector('#tituloModal').innerHTML = "Actualizar Color";
    document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTexto').innerHTML = "Actualizar";

    //Mostrar datos en formulario
    var idcolor = idColor;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Colores/getColor/'+idcolor;
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
                document.querySelector('#idColor').value = objData.data.idColor;
                document.querySelector('#txtNombreColores').value =objData.data.color;
                document.querySelector('#txtDescripciónColores').value =objData.data.descripción;

                $('#modalFromColores').modal('show');

            }
            else
            {
                swal("Error", objData.msg , "error");
            }
        }
    }
}

//eliminar un color
function fntEliminarColor(idColor)
{
    var idcolor = idColor;
    swal({
        title: "Eliminar color",
        text: "¿Seguro que quiere eliminar este color?",
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
            var ajaxUrl = base_url+'/Colores/eliminarColor/';
            var strData = "idColor="+idcolor;
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
                        tableColores.api().ajax.reload(function()
                        {
                            /*fntActualizarColor();
                            fntEliminarColor();*/
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
