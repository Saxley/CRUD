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
        <div class="modal-dialog">
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
                            <input type="text" class="form-control" id="nombre"  name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="cedula">Cédula:</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                            <p id="mensaje" style="color: orange; font-size: 14px;"></p>
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
                        <div id="verotro" style="display: none;">
                            Agregue el tipo de atención:
                            <input type="text" id="detalleatencion" name="detalleatencion">
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
</div>
    <script>
        document.getElementById("cedula").addEventListener("input", function() {
    let cedula = this.value;

    fetch("verificar_cedula.php?cedula=" + encodeURIComponent(cedula))
        .then(response => response.json())
        .then(data => {
            let mensaje = document.getElementById("mensaje");
            if (data.success === 1) {
                mensaje.textContent = "⚠️ Esta cédula ya ha sido registrada, pero puedes continuar.";
                mensaje.style.color = "orange";
            } else {
                mensaje.textContent = "";
            }
        })
        
});
    //Validando si existe la Cedula en BD antes de enviar el Form
    $("#cedula").on("keyup", function() {
    var cedula = $("#cedula").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
    var longitudCedula = $("#cedula").val().length; //CUENTO LONGITUD

    //Valido la longitud 
    if(longitudCedula >= 3){
        var dataString = 'cedula=' + cedula;

      $.ajax({
          url: 'verificar_cedula.php',
          type: "GET",
          data: dataString,
          dataType: "JSON",

          success: function(datos){

                if( datos.success == 1){

                $("#respuesta").html(datos.message);

                $("input").attr('disabled',true); //Desabilito el input nombre
                $("input#cedula").attr('disabled',false); //Habilitando el input cedula
                $("#btnEnviar").attr('disabled',true); //Desabilito el Botton

                }else{

                $("#respuesta").html(datos.message);

                $("input").attr('disabled',false); //Habilito el input nombre
                $("#btnEnviar").attr('disabled',false); //Habilito el Botton

                    }
                  }
                });
              }
          });

        
let id, nombre, apellido, cedula, fecha, telefono, entidad, tipoatencion, detalleatencion;
$(document).on("click", ".editModal", function () {
    
    id = $(this).data("id");
    nombre = $(this).data("nombre");
    apellido = $(this).data("apellido");
    cedula = $(this).data("cedula");
    fecha = $(this).data("fecha");
    telefono = $(this).data("telefono");
    entidad = $(this).data("entidad");
    tipoatencion = $(this).data("tipoatencion");
    detalleatencion = $(this).data("detalleatencion");

    // Llenar los campos del formulario
    $("#id").val(id);
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#cedula").val(cedula);
    $("#fecha").val(fecha);
    $("#telefono").val(telefono);
    $("#entidad").val(entidad);
    $("#tipoatencion").val(tipoatencion); 
    $("#detalleatencion").val(detalleatencion);

    // Verificar si debe mostrarse el campo "Otro"
    if (tipoatencion === "Otro") {
        $("#verotro").show();
        $("#detalleatencion").attr("required", true);
    } else {
        $("#verotro").hide();
        $("#detalleatencion").removeAttr("required").val(""); // Limpiar el campo
    }
});


    $('#editForm').on('submit', function(e) {
    e.preventDefault();

    // Serializamos los datos del formulario
    var data = $(this).serialize();
    console.log("Datos enviados:", data); 

    $.ajax({
        type: "POST",
        url: "Actualizar.php",
        data: data,
        dataType: "json",
        success: function(response) {
            console.log('Respuesta del servidor:', response);
            
            if (response.success) {  
                Swal.fire({
                    icon: 'success',
                    title: 'Datos capturados con éxito...!!',
                    showConfirmButton: false,
                    timer: 5000,
                    html: '<b>Nombre:</b> ' + data['nombre'] + '<br>' +
                          '<b>Apellido:</b> ' + data['apellido'] + '<br>' +
                          '<b>Cedula:</b> ' + data['cedula'] + '<br>' +
                          '<b>Fecha:</b> ' + data['fecha'] + '<br>' +
                          '<b>Telefono:</b> ' + data['telefono'] + '<br>' +
                          '<b>Entidad:</b> ' + data['entidad'] + '<br>' +
                          '<b>Tipoatencion:</b> ' + data['tipoatencion'] + '<br>' +
                          '<b>Otro:</b> ' + data['detalleatencion']
                }).then(function() {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    html: '<div class="alert alert-danger" role="alert">No se ha podido realizar...!<br>Reintente nuevamente por favor.</div>'
                });
            }
        }
    });
});

</script>
</body>
</html>