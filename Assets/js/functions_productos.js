var tableProductos;

document.addEventListener('DOMContentLoaded', function()
{
    tableProductos = $('#tableProductos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Productos/getProductos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idProducto" },
            { "data": "nombre" },
            { "data": "color" },
            { "data": "precio" },
            { "data": "cantidad" },
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
        "iDisplayLength": 50,
        "order": [[0, "asc"]]
    });
});

//id de datatables
$('#tableProductos').DataTable();


function openModal() 
{
    //para limpiar el modal
    document.querySelector('#idProductos').value = "";
    document.querySelector('.modal-header').classList.replace("headerActualizar", "headerRegistro");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnTexto').innerHTML = "Guardar";
    document.querySelector('#tituloModal').innerHTML = "Registro de productos";
    document.querySelector('#formProducto').reset();

    $('#modalFromProductos').modal('show');
}