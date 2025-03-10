<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre"  name="nombre" required>
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
                            <select id="tipoatencion" class="form-select" name="tipoatencion" onchange="funcion_otro();" required>
                            <option value="" selected>Seleccione el tipo de atención</option>
                            <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
                            <option value="Up-Virtual">Up-Virtual</option>
                            <option value="Otro">Otro</option>
                        </select>
                        </div>
                        <div id="verotro">
                            Agregue el tipo de atención:
                            <input type="text" id="otro" name="otro" required>
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
    <script>
    //FUNCIONA MUESTRA LOS DATOS DE LA FILA
    $(document).on("click", ".editarFila", function() {
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var apellido = $(this).data("apellido");
        var cedula = $(this).data("cedula");
        var fecha = $(this).data("fecha");
        var telefono = $(this).data("telefono");
        var entidad = $(this).data("entidad");
        var tipoatencion = $(this).data("tipoatencion");
        var detalleatencion = $(this).data("otro");

        // Llenar los campos del formulario en el modal
        $("#id").val(id);
        $("#nombre").val(nombre);
        $("#apellido").val(apellido);
        $("#cedula").val(cedula);
        $("#fecha").val(fecha);
        $("#telefono").val(telefono);
        $("#entidad").val(entidad);
        $("#tipoatencion").val(tipoatencion);
        $("#otro").val(detalleatencion);

        if (tipoatencion === "Otro") {
            $("#verotro").show();
        } else {
            $("#verotro").hide();
            $("#otro").val('');
        }
    });
    //VERIFICA LA CEDULA
    $("#cedula").on("keyup", function(event) {
    event.stopPropagation(); // Evita que el evento se propague
    var cedula = $("#cedula").val();
    var longitudCedula = cedula.length;

    if (longitudCedula >= 3) {
        var dataString = 'cedula=' + cedula;

        $.ajax({
            url: 'verificar_cedula.php',
            type: "GET",
            data: dataString,
            dataType: "JSON",
            success: function(datos) {
                $("#respuesta").html(datos.message);
                if (datos.success == 1) {
                    $("input").not("#cedula").attr('disabled', true);
                    $("#btnEnviar").attr('disabled', true);
                } else {
                    $("input").not("#cedula").attr('disabled', false);
                    $("#btnEnviar").attr('disabled', false);
                }
            }
        });
    }
});
    //_______ NO FUNCIONA REVISAR LOS MOTIVOS _____
    //Validando si existe la Cedula en BD antes de enviar el Form

    $('#editForm').on('submit', function(e) {
    e.preventDefault(); 
    console.log($(this).serialize()); // Para verificar los datos que se envían
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


</script>
</body>
</html>