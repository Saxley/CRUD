<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registros del departamento de innovación tecnológica</title>
    <link rel="icon" type="image/x-icon" href="./img/innovacion.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">   
    <style>
        .responsive {
            width: 15%; 
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .nav-item.dropdown {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center; 
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1050;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    .table-primary {
    background-color: #cce5ff;
    color: #004085;
}

    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
  </head>
  <body>
  <div class="header d-flex flex-wrap">
            <img src="./img/UP.png" alt="Universidad de Panamá" class="responsive">
    </div>
    <div class="text-center">
        <h2>ADMINISTRADOR</h2>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-right"> 
        <div class="container px-0">
        <a class="text-light" aria-current="page" style="text-decoration: none;">
                <script type="text/javascript">
                        var mydate = new Date();
                        var year = mydate.getFullYear(); 
                        var day = mydate.getDay();
                        var month = mydate.getMonth();
                        var daym = mydate.getDate();
                        
                        var dayarray = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
                        var montharray = new Array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

                        document.write(dayarray[day] + " " + daym + " de " + montharray[month] + " de " + year);
                </script>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="add.php" id="addbtn" data-bs-toggle="modal" data-bs-target="#add">
                    <i class="bi bi-person-fill-add"></i>
                        Introducir nuevo dato
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill-down"></i>
                        Reporte
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="./fpdf/ReporteAdministrativo.php" target="_blank" id="pdfadmin">Reporte por entidad administrativa</a></li>
                        <li><a class="dropdown-item" href="./fpdf/ReporteEstudiante.php" target="_blank" id="pdfestudiante">Reporte por entidad estudiantes</a></li>
                        <li><a class="dropdown-item" href="./fpdf/ReporteProfesor.php" target="_blank" id="pdfprof">Reportes por entidad profesor</a></li>          
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" id="cerrarsesion">
                    <i class="bi bi-box-arrow-right"></i>
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php include 'modal_agregar.php';?>
    <?php include 'modal_editar.php';?>
</nav>

    <!-- USUARIOS -->
    <div class="modal-body">
    <form>
        <div class="card my-5 mx-2">
        <div class="card-header">
        <h5 class="card-title text-center py-2"><strong>REGISTROS</strong></h5>
    </div>
    <div class="row g-4 py-4 align-items-center">
        <div class="col-auto">
            <label for="num_registros" class="col-form-label">Mostrar:</label>
        </div>
        <div class="col-auto ms-2">
            <select name="num_registros" id="num_registros" class="form-select">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-auto">
        <label for="campo" class="col-form-label">Buscar: </label>
                </div>
                <div class="col-6 col-md-3 text-end">
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
    </div>

    <table class="table table-striped table-white" id="tblDatos"></table>
            <div id="paginador" class="d-flex justify-content-end mt-4"></div>
  <script>
    let datos = [];  // Aquí guardaremos los datos obtenidos
    let registrosPorPagina = 10; 
    let paginaActual = 1;  // Página por defecto

    // Obtener los datos desde el servidor
    fetch('load.php')
        .then(response => response.json())
        .then(data => {
            datos = data;
            mostrarDatos();
        })
        .catch(error => console.error('Error:', error));
    
    function obtenerDatosPaginacion() {
        const url = `load_v2.php?p=${paginaActual}&rpp=${registrosPorPagina}&search=${searchQuery}`;  
        fetch(url)
            .then(response => response.json())
            .then(data => {
                datos = data;
                mostrarDatos();
            })
            .catch(error => console.error('Error:', error));
    }
// Función para mostrar los datos en la tabla
function mostrarDatos() {
    const tblDatos = document.getElementById("tblDatos");
    tblDatos.innerHTML = ""; // Limpiar tabla antes de mostrar los datos

    // Crear encabezado
    const encabezado = tblDatos.createTHead();
    const filaEncabezado = encabezado.insertRow();
    filaEncabezado.classList.add("table-primary");
    filaEncabezado.insertCell().textContent = "Id";
    filaEncabezado.insertCell().textContent = "Nombre";
    filaEncabezado.insertCell().textContent = "Apellido";
    filaEncabezado.insertCell().textContent = "Cedula";
    filaEncabezado.insertCell().textContent = "Fecha";
    filaEncabezado.insertCell().textContent = "Telefono";
    filaEncabezado.insertCell().textContent = "Entidad";
    filaEncabezado.insertCell().textContent = "Tipo de atencion";
    filaEncabezado.insertCell().textContent = "Detalle de Atención";
    filaEncabezado.insertCell().textContent = "Acciones";

    // Crear cuerpo de la tabla
    const cuerpo = tblDatos.createTBody();

    const inicio = (paginaActual - 1) * registrosPorPagina;
    const fin = Math.min(inicio + registrosPorPagina, datos.length);

    for (let i = inicio; i < fin; i++) {
        const fila = cuerpo.insertRow();
        const row = datos[i];

        for (const key in row) {
            const celda = fila.insertCell();
            celda.textContent = row[key];
        }

        const celdaAccion = fila.insertCell();
celdaAccion.innerHTML = `
    <button type="button" class="btn btn-danger btn-sm eliminarFila" data-id="${row.id}">
        Eliminar
    </button>
    <button type="button" class="btn btn-success btn-sm editarFila" data-bs-toggle="modal" data-bs-target="#editModal"
        data-id="${row.id}" 
        data-nombre="${row.Nombre}" 
        data-apellido="${row.Apellido}" 
        data-cedula="${row.Cedula}"
        data-fecha="${row.Fecha}"
        data-telefono="${row.Telefono}"
        data-entidad="${row.Entidad}"
        data-tipoatencion="${row.Tipoatencion}"
        data-otro="${row.Otro ?? ''}"> <!-- Asegura que "otro" no sea undefined -->
        Editar
    </button>
`;

    }

    mostrarPaginacion();
}


function mostrarPaginacion() {
    const paginador = document.getElementById("paginador");
    const totalPaginas = Math.ceil(datos.length / registrosPorPagina);
    paginador.innerHTML = "";

   
    const ul = document.createElement("ul");
    ul.className = "pagination";

    // Botón "Anterior"
    const prevLi = document.createElement("li");
    prevLi.className = `page-item ${paginaActual === 1 ? "disabled" : ""}`;
    prevLi.innerHTML = `<a class="page-link" href="#">‹</a>`;
    if (paginaActual > 1) {
        prevLi.addEventListener("click", () => cambiarPagina(paginaActual - 1));
    }
    ul.appendChild(prevLi);

    // Botones de las páginas
    for (let i = 1; i <= totalPaginas; i++) {
        const li = document.createElement("li");
        li.className = `page-item ${i === paginaActual ? "active" : ""}`;
        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        li.addEventListener("click", () => cambiarPagina(i));
        ul.appendChild(li);
    }

    // Botón "Siguiente"
    const nextLi = document.createElement("li");
    nextLi.className = `page-item ${paginaActual === totalPaginas ? "disabled" : ""}`;
    nextLi.innerHTML = `<a class="page-link" href="#">›</a>`;
    if (paginaActual < totalPaginas) {
        nextLi.addEventListener("click", () => cambiarPagina(paginaActual + 1));
    }
    ul.appendChild(nextLi);

    paginador.appendChild(ul);
}


    // Cambiar de página
    function cambiarPagina(pagina) {
        if (pagina > 0 && pagina <= Math.ceil(datos.length / registrosPorPagina)) {
            paginaActual = pagina;
            mostrarDatos();
        }
    }

    // Cambiar el número de registros por página
    document.getElementById("num_registros").addEventListener("change", function () {
        registrosPorPagina = parseInt(this.value);
        paginaActual = 1; 
        mostrarDatos();
    });

    // Filtrar la tabla según el valor ingresado en el campo de búsqueda
    function myFunction() {
        const input = document.getElementById("campo");
        const filter = input.value.toUpperCase();
        const rows = document.querySelectorAll("#tblDatos tbody tr"); // Cambio aquí

        rows.forEach(row => {
            let found = false;
            const cells = row.getElementsByTagName("td");

            for (let i = 0; i < cells.length; i++) {
                let cell = cells[i];
                if (cell && cell.textContent.toUpperCase().includes(filter)) {
                    found = true;
                    break;
                }
            }

            if (found) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Resetear la paginación después de filtrar
        paginaActual = 1;
        mostrarPaginacion();
    }

    // Eliminar una fila de la tabla
    function eliminarFila(button) {
        const fila = button.parentElement.parentElement;
        fila.remove();
    }

    $(document).on("click", ".eliminarFila", function(event) {
    event.preventDefault();
    var atencion_id = $(this).data('id');

    Swal.fire({
        title: '¿Está seguro de eliminar?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("./eliminar.php", { id: atencion_id }, function(response) {
                if (response.status === 'success') {
                    Swal.fire('Eliminado!', response.message, 'success');
                    // Eliminar la fila de la tabla sin recargar
                    $(`button[data-id="${atencion_id}"]`).closest("tr").remove();
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }, "json").fail(function() {
                Swal.fire('Error!', 'Ocurrió un error al intentar eliminar.', 'error');
            });
        }
    });
});


            

            $('#cerrarsesion').click(function(e) {
                    e.preventDefault(); 

                    $.ajax({
                        url: 'logout.php', 
                        type: 'POST',
                        success: function(response) {
                            const data = JSON.parse(response); 
                            if (data.success) {
                                window.location.href = 'index.php'; 
                            } else {
                                alert('Error al cerrar sesión');
                            }
                        },
                        error: function() {
                            alert('Error en la solicitud AJAX');
                        }
                    });
                });

    </script>
  
  </body>
</html>