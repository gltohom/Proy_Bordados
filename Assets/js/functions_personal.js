var tablePersonal;

document.addEventListener('DOMContentLoaded', function()
{
    tablePersonal = $('#tablePersonal').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Personal/getPersonal",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idPersonal" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "dirección" },
            { "data": "teléfono" },
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

    //nuevo personal y validacion de campos
    var formPersona = document.querySelector("#formPersona");
    formPersona.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdPersonal = document.querySelector('#idPersonal').value;
        var strNombre = document.querySelector('#txtNombrePersonal').value;
        var strApellido = document.querySelector('#txtApellidoPersonal').value;
        var strDirección = document.querySelector('#txtDirecciónPersonal').value;
        var intTeléfono = document.querySelector('#intTeléfonoPersonal').value;
        if(strNombre == '' || strApellido == ''|| strDirección == '') 
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
        var ajaxUrl = base_url+'/Personal/setPersona';
        var formData = new FormData(formPersona);
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

                    $('#modalFormPersonal').modal("hide");
                    formPersona.reset();
                    swal("Personal", objData.msg ,"success");
                    tablePersonal.api().ajax.reload(function()
                    {
                        /*fntActualizarPersona();
                        fntEliminarPersona();**/
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
$('#tablePersonal').DataTable();

function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idPersonal').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de personal";
    document.querySelector('#formPersona').reset();

    $('#modalFromPersonal').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    /*fntActualizarPersona();
    fntEliminarPersona();*/
}, false);

//para asignar la funcion a todos los id btnActualizar
function fntActualizarPersona(idPersonal)
{
    document.querySelector('#tituloModal').innerHTML = "Actualizar Persona";
    document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTexto').innerHTML = "Actualizar";

    //Mostrar datos en formulario
    var idpersonal = idPersonal;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Personal/getPersona/'+idpersonal;
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
                document.querySelector('#idPersonal').value = objData.data.idPersonal;
                document.querySelector('#txtNombrePersonal').value =objData.data.nombre;
                document.querySelector('#txtApellidoPersonal').value =objData.data.apellido;
                document.querySelector('#txtDirecciónPersonal').value =objData.data.dirección;
                document.querySelector('#intTeléfonoPersonal').value =objData.data.teléfono;

                $('#modalFromPersonal').modal('show');

            }
            else
            {
                swal("Error", objData.msg , "error");
            }
        }
    }
}

//eliminar un color
function fntEliminarPersona(idPersonal)
{
    var idpersonal = idPersonal;
    swal({
        title: "Eliminar Personal",
        text: "¿Seguro que quiere eliminar a esta persona?",
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
            var ajaxUrl = base_url+'/Personal/eliminarPersona/';
            var strData = "idPersonal="+idpersonal;
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
                        tablePersonal.api().ajax.reload(function()
                        {
                            /*fntActualizarPersona();
                            fntEliminarPersona();*/
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