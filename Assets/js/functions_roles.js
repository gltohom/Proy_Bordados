var tableRoles;

document.addEventListener('DOMContentLoaded', function()
{

    tableRoles = $('#tableRoles').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idRol" },
            { "data": "rol" },
            { "data": "descripción" },
            { "data": "estado" },
            { "data": "permisos" },
            { "data": "actualizar" },
            { "data": "eliminar" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    //nuevo rol y validacion de campos
    var formRol = document.querySelector("#formRol");
    formRol.onsubmit = function(e)
    {
        e.preventDefault();

        var intIdRol = document.querySelector('#idRol').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripción = document.querySelector('#txtDescripción').value;
        var intEstado = document.querySelector('#listEstado').value;
        if(strNombre == '' || strDescripción == '' || intEstado == '') 
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
        var ajaxUrl = base_url+'/Roles/setRol';
        var formData = new FormData(formRol);
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

                    $('#modalFormRoles').modal("hide");
                    formRol.reset();
                    swal("Roles de usuario", objData.msg ,"success");
                    tableRoles.api().ajax.reload(function()
                    {
                        fntActualizarRol();
                        fntEliminarRol();
                        fntPermisos();
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
$('#tableRoles').DataTable();

//funcion para llamar el formulario cuando se presione el botón
function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idRol').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de nuevo rol";
    document.querySelector('#formRol').reset();

    $('#modalFromRoles').modal('show');
}

//para que cargue desde que se carga el documento
window.addEventListener('load', function()
{
    fntActualizarRol();
    fntEliminarRol();
    fntPermisos();
}, false);

//para asignar la funcion a todos los id btnActualizarRol
function fntActualizarRol()
{
    var btnActualizarRol = document.querySelectorAll(".btnActualizarRol");
    btnActualizarRol.forEach(function(btnActualizarRol)
    {
        btnActualizarRol.addEventListener('click', function()
        {
            document.querySelector('#tituloModal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegistro", "headerActualizar");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnTexto').innerHTML = "Actualizar";

            //Mostrar datos en formulario
            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Roles/getRol/'+idrol;
            request.open("GET", ajaxUrl, true);
            request.send();

            //para obtener la respuesta a la peticion
            request.onreadystatechange = function()
            {
                if (request.readyState == 4 && request.status == 200) 
                {
                    var objData = JSON.parse(request.responseText);

                    //validar los datos a mostrar
                    if (objData.estado) 
                    {
                        document.querySelector('#idRol').value = objData.data.idRol;
                        document.querySelector('#txtNombre').value =objData.data.rol;
                        document.querySelector('#txtDescripción').value =objData.data.descripción;

                        if (objData.data.estado == 1)
                        {
                            var optionSelect = '<option value = "1" selected class="notBlock">Activo</option>';
                        }
                        else
                        {
                            var optionSelect = '<option value = "2" selected class="notBlock">Inactivo</option>';
                        }

                        var htmlSelect = `${optionSelect}
                                        <option value ="1">Activo</option>
                                        <option value ="2">Inactivo</option>
                                        `;
                        document.querySelector("#listEstado").innerHTML = htmlSelect;
                        $('#modalFromRoles').modal('show');
                    }
                    else
                    {
                        swal("Error", objData.msg , "error");
                    }
                }
            }
        });
    });
}

//eliminar un rol
function fntEliminarRol()
{
    var btnEliminarRol = document.querySelectorAll(".btnEliminarRol");
    btnEliminarRol.forEach(function(btnEliminarRol) {
        btnEliminarRol.addEventListener('click', function()
        {
            var idrol = this.getAttribute("rl");
            swal({
                title: "Eliminar Rol",
                text: "¿Seguro que quiere eliminar este Rol?",
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
                    var ajaxUrl = base_url+'/Roles/eliminarRol/';
                    var strData = "idRol="+idrol;
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
                                tableRoles.api().ajax.reload(function()
                                {
                                    fntActualizarRol();
                                    fntEliminarRol();
                                    fntPermisos();
                                });
                            }else
                            {
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }
            });
        });
    });
}

//para el boton de permisos, funcion
function fntPermisos()
{
    var btnPermisosRol = document.querySelectorAll(".btnPermisosRol");
    btnPermisosRol.forEach(function(btnPermisosRol)
    {
        btnPermisosRol.addEventListener('click', function()
        {
            
            
            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();

            
            request.onreadystatechange = function()
            {
                if(request.readyState == 4 && request.status == 200)
                {
                    document.querySelector('#contentAjax').innerHTML = request.responseText;
                    $('.modalPermisos').modal('show');
                    document.querySelector('#formPermisos').addEventListener('submit',fntGuardarPermisos,false);
                }
            }
        });
    });
}

//guardar permisos de roles
function fntGuardarPermisos(evnet)
{
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Permisos/setPermisos'; 
    var formElement = document.querySelector("#formPermisos");
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    //validación de datos
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                swal("Permisos de usuario", objData.msg ,"success");
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
    
}