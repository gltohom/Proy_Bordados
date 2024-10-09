var tableUsuarios;
 
document.addEventListener('DOMContentLoaded', function() {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "usuario" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "rol" },
            { "data": "estado" },
            { "data": "ver" },
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
        "order": [
            [0, "asc"]
        ]
    });

    //nuevo usuario y validacion de campos
    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdUsuario = document.querySelector('#idUsuario').value;
        var strUsuario = document.querySelector('#txtUsuario').value;
        var strContraseña = document.querySelector('#txtContraseña').value;
        var intEstado = document.querySelector('#listEstado').value;
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
}, false);


//id de datatables
$('#tableUsuarios').DataTable();

function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de Usuario";
    document.querySelector('#formUsuario').reset();

    $('#modalFromUsuarios').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    fntRolesUsuario();
    fntPersonalUsuario();
}, false);

//para extraer lista de roles desde la base de datos 
function fntRolesUsuario()
{
    var ajaxUrl = base_url+'/Roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listIdRol').innerHTML = request.responseText;
            document.querySelector('#listIdRol').value = 1;
            $('#listIdRol');
        }
    }
    
}

//para extraer lista de personal desde la base de datos 
function fntPersonalUsuario()
{
    var ajaxUrl = base_url+'/Personal/getSelectPersonal';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listIdPersonal').innerHTML = request.responseText;
            document.querySelector('#listIdPersonal').value = 1;
            $('#listIdPersonal');
        }
    }
    
}

function fntVerUsuario(idUsuario)
{
    var idUsuario = idUsuario;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Usuarios/getUsuarioTabla/'+idUsuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               var estadoUsuario = objData.data.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#tablaNombre").innerHTML = objData.data.nombre;
                document.querySelector("#tablaApellido").innerHTML = objData.data.apellido;
                document.querySelector("#tablaUsuario").innerHTML = objData.data.usuario;
                document.querySelector("#tablaDirección").innerHTML = objData.data.dirección;
                document.querySelector("#tablaTeléfono").innerHTML = objData.data.teléfono;
                document.querySelector("#tablaRol").innerHTML = objData.data.rol;
                document.querySelector("#tablaEstado").innerHTML = estadoUsuario;
                document.querySelector("#tablaFecha").innerHTML = objData.data.fechaRegistro; 
                $('#modalVerUsuario').modal('show');
            }else
            {
                swal("Error", objData.msg , "error");
            }
        }
    }
}

//para actualizar los datos de usuario
function fntActualizarUsuario(idUsuario)
{
    document.querySelector('#tituloModal').innerHTML = "Actualizar Persona";
    document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnTexto').innerHTML = "Actualizar";
    

    var idUsuario =idUsuario;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Usuarios/getUsuario/'+idUsuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idUsuario").value = objData.data.idUsuario;
                document.querySelector("#txtUsuario").value = objData.data.usuario;
                document.querySelector("#listEstado").value = objData.data.estado;
                document.querySelector("#listIdRol").value = objData.data.idRol;
                document.querySelector("#listIdPersonal").value = objData.data.idPersonal;
                $('#listIdRol').selectpicker('render');
                $('#listIdPersonal').selectpicker('render');

                if(objData.data.estado == 1)
                {
                    document.querySelector("#listEstado").value = 1;
                }else
                {
                    document.querySelector("#listEstado").value = 2;
                }
                $('#listEstado').selectpicker('render');
            }
        }
        $('#modalFromUsuarios').modal('show');
    }
}




//eliminar un rol
function fntEliminarUsuario(idUsuario)
{
    var idusuario = idUsuario;
    swal({
        title: "Eliminar Usuario",
        text: "¿Seguro que quiere eliminar este Usuario?",
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
            var ajaxUrl = base_url+'/Usuarios/eliminarUsuario/';
            var strData = "idUsuario="+idusuario;
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
                        tableUsuarios.api().ajax.reload(function()
                        {
                            fntRolesUsuario();
                            fntPersonalUsuario();
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