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
       body {
            padding: 0;
            margin: 0;
        }
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

        
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .position-absolute {
            position: absolute;
            top: 0; 
            right: 0;
            max-width: 100px; 
        }

        .header {
            padding: 1rem;
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        .navbar {
            padding: 0.5rem 1rem;
        }

        .modal-body {
            padding: 1rem;
        }

        @media (max-width: 767px) {
            .modal-body {
                padding: 0.5rem;
            }

            .form-control,
            .form-select {
                width: 100%;
            }
        }

        .table {
            width: 100%;
            overflow-x: auto; 
        }

        .card {
            margin: 1rem 0;
        }

        .row.g-4 {
            flex-wrap: wrap;
        }

        .text-end {
            text-align: end;
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
            <label for="myInput" class="col-form-label">Registros:</label>
        </div>
        <div class="col-md-5 d-flex align-items-center justify-content-end">
            <span class="me-2">Buscar:</span>
            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" style="width: auto;">
        </div>
    </div>


        <div class="row py-4">
            <div class="col">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="sort asc">#</th>
                            <th class="sort asc">Nombre</th>
                            <th class="sort asc">Apellido</th>
                            <th class="sort asc">Cédula</th>
                            <th class="sort asc">Fecha</th>
                            <th class="sort asc">Teléfono</th>
                            <th class="sort asc">Entidad</th>
                            <th class="sort asc">Tipo de atención</th>
                            <th class="sort asc">Detalle de atención</th>
                            <th class="sort asc">Acciones</th> 
                        </tr>
                    </thead>
                    <tbody id="content"></tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="row justify-content-between">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <label id="lbl-total"></label>
            </div>
            <div class="col-12 col-md-4 mb-2 mb-md-0" id="nav-paginacion"></div>

            <input type="hidden" id="pagina" value="1">
            <input type="hidden" id="orderCol" value="0">
            <input type="hidden" id="orderType" value="asc">
        </div>
    </div>
</div>
   <!-- Modal para agregar registro -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post">
                    <div class="mb-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="cedula">Cédula:</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="entidad">Entidad:</label>
                        <select id="entidad" class="form-select" name="entidad" required>
                            <option value="" selected>Seleccione la entidad</option>
                            <option value="Estudiante">Estudiante</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Profesor">Profesor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipoatencion">Tipo de atención:</label>
                        <select id="tipoatencion" name="tipoatencion" onchange="funcion_otro();" required>
                            <option value="" selected>Seleccione el tipo de atención</option>
                            <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
                            <option value="Up-Virtual">Up-Virtual</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div id="verotro" style="display:none;">
                            Agregue el tipo de atención:
                            <input type="text" id="otro" name="otro">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Modal para editar registro -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido "name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="cedula">Cédula:</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                        <div class="mb-3">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" class="form-control" id="telefono"name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="entidad" class="form-label">Entidad:</label>
                            <select id="entidad" class="form-select" name="entidad" required>
                                <option value="" selected>Seleccione la entidad</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Administrativo">Administrativo</option>
                                <option value="Profesor">Profesor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipoatencion">Tipo de atención:</label>
                            <select id="tipoatencion" name="tipoatencion" onchange="funcion_otro();" required>
                            <option value="" selected>Seleccione el tipo de atención</option>
                            <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
                            <option value="Up-Virtual">Up-Virtual</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div id="verotro">
                            Agregue el tipo de atención:
                            <input type="text" id="otro" name="otro" required>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center text-sm-start text-dark" style="background-color: #ffffff">
    
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4" style="background-color: #ffffff">
            <div>
            <a href="#top" aria-label="Back to top">
            <i class="fa fa-chevron-circle-up"></i>
                </a>
            </div>
        </section>
        <section>
        <div class="container text-center text-md-start mt-5 position-relative">
          <div class="w-auto p-3">
              <hr class="mb-4 mt-0" style="width: 30px; background-color: #7c4dff; height: 2px" />
                <p>
                    Universidad de Panamá<br>
                    Centro Regional Universitario de Azuero
                </p>
            </div>
            <div class="col-md-4 position-absolute" style="top: 0; right: 0; display: flex; flex-direction: column; align-items: flex-end;">
                <img src="./img/deptinnovacion.png" alt="Innovación Tecnológica" class="img-fluid" style="max-width: 100px;" />
                <p style="margin-left: -50px;">innovacion.crua@up.ac.pa</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
   <script>
    $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var dataInfo = JSON.parse(button.attr('data-info')); 
    
    $(this).find('#id').val(dataInfo.id);
    $(this).find('#nombre').val(dataInfo.nombre);
    $(this).find('#apellido').val(dataInfo.apellido);
    $(this).find('#cedula').val(dataInfo.cedula);
    $(this).find('#fecha').val(dataInfo.fecha);
    $(this).find('#telefono').val(dataInfo.telefono);
    $(this).find('#entidad').val(dataInfo.entidad);
    $(this).find('#tipoatencion').val(dataInfo.tipoatencion);
    $(this).find('#otro').val(dataInfo.Detalleatencion); 
   
    function funcion_otro() {
    var tipoatencion = document.getElementById('tipoatencion').value;
    
    if (tipoatencion === "Otro") {
        document.getElementById('verotro').style.display = 'block';
    } else {
        document.getElementById('verotro').style.display = 'none';
    }
}
});

    $('#editForm').on('submit', function(e) {
        e.preventDefault(); 
        let fechaIngresada = $('#fecha').val(); // Obtiene la fecha del input
        console.log("Fecha ingresada:", fechaIngresada);

        $.ajax({
            type: "POST",
            url: "Actualizar.php",  
            data: $(this).serialize(),  
            dataType: "json", 
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Éxito', response.message, 'success').then(() => {
                        location.reload(); 
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Ocurrió un error en la solicitud.', 'error');
            }
        });
    });

            // Filtrar resultados de la tabla
            function myFunction() {
                var input = document.getElementById("myInput");
                var filter = input.value.toUpperCase();
                var table = document.querySelector("table");
                var tr = table.getElementsByTagName("tr");

                for (let i = 1; i < tr.length; i++) {
                    tr[i].style.display = "none";
                    for (let j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                        let td = tr[i].getElementsByTagName("td")[j];
                        if (td) {
                            let txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break;
                            }
                        }
                    }
                }
            }
            

           // Cargar datos al cargar la página
document.addEventListener("DOMContentLoaded", getData);

function getData() {
    let input = document.getElementById("myInput").value;
    let num_registros = document.getElementById("num_registros").value;
    let content = document.getElementById("content");
    let pagina = document.getElementById("pagina").value || 1;
    let orderCol = document.getElementById("orderCol").value;
    let orderType = document.getElementById("orderType").value;

    let formaData = new FormData();
    formaData.append('campo', input);
    formaData.append('registros', num_registros);
    formaData.append('pagina', pagina);
    formaData.append('orderCol', orderCol);
    formaData.append('orderType', orderType);

    fetch("load.php", {
        method: "POST",
        body: formaData
    })
    .then(response => response.json()) // Convertimos la respuesta a JSON
    .then(data => {
        console.log(data); // Para depuración

        // Construir las filas de la tabla dinámicamente
        let filas = "";
        if (data.data.length > 0) {
            data.data.forEach(row => {
                filas += `<tr>
                    <td>${row.nombre}</td>
                    <td>${row.apellido}</td>
                    <td>${row.Cedula}</td>
                    <td>${row.fecha}</td>
                    <td>${row.teléfono}</td>
                </tr>`;
            });
        } else {
            filas = `<tr><td colspan="5">Sin resultados</td></tr>`;
        }
        
        // Insertamos las filas en la tabla
        content.innerHTML = filas;

        // Actualizar paginación y total de registros
        document.getElementById("lbl-total").innerText = `Total registros: ${data.totalRegistros}`;
        document.getElementById("nav-paginacion").innerHTML = data.paginacion;

        // Si no hay resultados y la página no es la primera, volver a la primera
        if (data.data.length === 0 && parseInt(pagina) !== 1) {
            nextPage(1);
        }
    })
    .catch(err => console.error("Error en la petición:", err));
}

function nextPage(pagina) {
    document.getElementById('pagina').value = pagina;
    getData();
}


            function ordenar(e) {
                let elemento = e.target;
                let orderType = elemento.classList.contains("asc") ? "desc" : "asc";
                document.getElementById('orderCol').value = elemento.cellIndex;
                document.getElementById("orderType").value = orderType;
                elemento.classList.toggle("asc");
                elemento.classList.toggle("desc");
                getData();
            }

            document.getElementById("num_registros").addEventListener("change", getData);

            document.querySelectorAll(".sort").forEach(column => {
                column.addEventListener("click", ordenar);
            });
        

                $(document).on("click", ".eliminar", function(event) {
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
                            $.ajax({
                                method: "POST",
                                url: "./eliminar.php",
                                data: { id: atencion_id },
                                dataType: "json",
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire('Eliminado!', response.message, 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Error!', response.message, 'error');
                                    }
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Ocurrió un error al intentar eliminar.', 'error');
                                }
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