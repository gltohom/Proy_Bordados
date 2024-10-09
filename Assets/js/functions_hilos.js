var tableHilos;

document.addEventListener('DOMContentLoaded', function()
{
    tableHilos = $('#tableHilos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Hilos/getHilos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idHilo" },
            { "data": "color" },
            { "data": "código" },
            { "data": "tipo" },
            { "data": "cantidad" },
            { "data": "descripción" },
            { "data": "editar" },
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

    //nuevo usuario y validacion de campos
    var formHilo = document.querySelector("#formHilo");
    formHilo.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdHilo = document.querySelector('#idHilo').value;
        var intIdColor = document.querySelector('#listColorHilos').value;
        var intIdRol = document.querySelector('#listIdRol').value;
        var intIdPersonal = document.querySelector('#listIdPersonal').value;

        //validación de los campos obligatorios
        if(strUsuario == '' || strContraseña == '' || intEstado == '' || intIdRol =='' || intIdPersonal == '')
        {
            swal("Atención", "Debe llenar los campos obligatorios", "error");
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
        var ajaxUrl = base_url+'/Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
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

                    $('#modalFromUsuarios').modal("hide");
                    formUsuario.reset();
                    swal("Usuarios", objData.msg ,"success");
                    tableUsuarios.api().ajax.reload(function()
                    {
                        fntRolesUsuario();
                        fntPersonalUsuario();
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
$('#tableHilos').DataTable();


function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idHilos').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de hilos";
    document.querySelector('#formHilo').reset();

    $('#modalFromHilos').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    fntColoresHilos();
}, false);


//para extraer lista de personal desde la base de datos 
function fntColoresHilos()
{
    var ajaxUrl = base_url+'/Colores/getSelectColor';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listColorHilos').innerHTML = request.responseText;
            document.querySelector('#listColorHilos').value = 1;
            $('#listColorHilos');
        }
    }
    
}