var tableDiseños;

document.addEventListener('DOMContentLoaded', function()
{
    tableDiseños = $('#tableDiseños').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Diseños/getDiseños",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idDiseño" },
            { "data": "nombre" },
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

    //nuevo diseño y validacion de campos
    var formDiseño = document.querySelector("#formDiseño");
    formDiseño.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdDiseño = document.querySelector('#idDiseño').value;
        var strNombre = document.querySelector('#txtNombreDiseños').value;
        var strDescripción = document.querySelector('#txtDescripciónDiseños').value;
        if(strNombre == '') 
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
        var ajaxUrl = base_url+'/Diseños/setDiseño';
        var formData = new FormData(formDiseño);
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

                    $('#modalFormDiseños').modal("hide");
                    formDiseño.reset();
                    swal("Diseños", objData.msg ,"success");
                    tableDiseños.api().ajax.reload(function()
                    {
                        /*fntActualizarDiseño();
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
$('#tableDiseños').DataTable();


function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idDiseño').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de diseño";
    document.querySelector('#formDiseño').reset();

    $('#modalFromDiseños').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    /*fntActualizarDiseño();
    fntEliminarDiseño();*/
}, false);

//para asignar la funcion a todos los id btnActualizarDiseño
function fntActualizarDiseño(idDiseño)
{
    document.querySelector('#tituloModal').innerHTML = "Actualizar Diseño";
    document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTexto').innerHTML = "Actualizar";

    //Mostrar datos en formulario
    var iddiseño = idDiseño;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Diseños/getDiseño/'+iddiseño;
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
                document.querySelector('#idDiseño').value = objData.data.idDiseño;
                document.querySelector('#txtNombreDiseños').value =objData.data.nombre;
                document.querySelector('#txtDescripciónDiseños').value =objData.data.descripción;

                $('#modalFromDiseños').modal('show');

            }
            else
            {
                swal("Error", objData.msg , "error");
            }
        }
    }
}

//eliminar un Diseño
function fntEliminarDiseño(idDiseño)
{
    var iddiseño = idDiseño;
    swal({
        title: "Eliminar diseño",
        text: "¿Seguro que quiere eliminar este diseño?",
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
            var ajaxUrl = base_url+'/Diseños/eliminarDiseño/';
            var strData = "idDiseño="+iddiseño;
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
                        tableDiseños.api().ajax.reload(function()
                        {
                            /*fntActualizarDiseño();
                            fntEliminarDiseño();*/
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