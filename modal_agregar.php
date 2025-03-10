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
    <!-- Modal para agregar registro -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post">
                    <input type="hidden" name="id" id="addId"> 
                    <div class="mb-3">
                        <label for="addNombre">Nombre:</label>
                        <input type="text" class="form-control" id="addNombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="addApellido">Apellido:</label>
                        <input type="text" class="form-control" id="addApellido" name="apellido">
                    </div>
                    <div class="mb-3">
                        <label for="addCedula">Cédula:</label>
                        <input type="text" class="form-control" id="addCedula" name="cedula">
                    </div>
                    <div class="mb-3">
                        <label for="addFecha">Fecha:</label>
                        <input type="date" class="form-control" id="addFecha" name="fecha">
                    </div>
                    <div class="mb-3">
                        <label for="addTelefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="addTelefono" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="addEntidad" class="form-label">Entidad:</label>
                        <select id="addEntidad" class="form-select" name="entidad">
                            <option value="" selected>Seleccione la entidad</option>
                            <option value="Estudiante">Estudiante</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Profesor">Profesor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addTipoAtencion">Tipo de atención:</label>
                        <select id="addTipoatencion" name="tipoatencion" onchange="funcion_otro();">
                            <option value="" selected>Seleccione el tipo de atención</option>
                            <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
                            <option value="Up-Virtual">Up-Virtual</option>
                            <option value="Otro">Otro</option>
                        </select>
                        <div id="verOtroAdd" style="display:none;">
                            Agregue el tipo de atención:
                            <input type="text" id="addOtro" name="otro">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="registro">Guardar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function funcion_otro() {
        var tipoAtencion = document.getElementById("addTipoatencion").value;
        var verOtro = document.getElementById("verOtroAdd");

        if (tipoAtencion === "Otro") {
            verOtro.style.display = "block";
        } else {
            verOtro.style.display = "none";
        }
    }

    //Validando si existe la Cedula en BD antes de enviar el Form
    $("#addCedula").on("keyup", function() {
    var cedula = $("#addCedula").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
    var longitudCedula = $("#addCedula").val().length; //CUENTO LONGITUD

    //Valido la longitud 
    if(longitudCedula >= 3){
        var dataString = 'addCedula=' + cedula;

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

$('#addForm').submit(function(event) {
    event.preventDefault();

    var nombre = $("#addNombre").val();
    var apellido = $("#addApellido").val();
    var cedula = $("#addCedula").val();
    var fecha = $("#addFecha").val();
    var tel = $("#addTelefono").val();
    var entidad = $("#addEntidad").val();
    var tipoatencion = $("#addTipoatencion").val(); 
    var otro = $("#addOtro").val() || "";  

    var data = {
        nombre: nombre,
        apellido: apellido,
        cedula: cedula,
        fecha: fecha,
        telefono: tel,
        entidad: entidad,
        tipoatencion: tipoatencion,
        otro: otro
    };

    $.ajax({
    url: 'registro.php',
    type: 'POST',
    data: data,
    success: function(response) {
      console.log('Respuesta del servidor:', response);

      // Verifica la existencia de la cédula antes de procesar el resultado
      if (response.coincidencia) {
        // Si la cédula ya existe, muestra el mensaje correspondiente
        Swal.fire({
          icon: 'warning',
          title: '¡Atención!',
          text: response.message || 'La cédula ya existe en el sistema.'
        });
      } else {
        // Si el registro es exitoso, muestra los datos
        if (response.response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Datos capturados con éxito!',
            html: Object.entries(data).map(([key, value]) => `${key}: ${value}`).join('<br>'),
            showConfirmButton: false,
            timer: 5000
          }).then(() => location.reload());
        } else {
          // En caso de error al guardar
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.response.message || 'No se pudo guardar los datos. Intenta nuevamente.'
          });
        }
      }
    }
  });
});
</script>
</body>
</html>