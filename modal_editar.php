<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
  <!-- Modal -->
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
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="apellido">Apellido:</label>
              <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
              <label for="cedula">Cédula:</label>
              <input type="text" class="form-control" id="cedula" name="cedula" required>
              <label id="aviso"></label>
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
              <select id="tipoatencion" class="form-select" name="tipoatencion" required>
                <option value="" selected>Seleccione el tipo de atención</option>
                <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
                <option value="Up-Virtual">Up-Virtual</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div id="verotro" style = "display: none;">
              Agregue el tipo de atención:
              <input type="text" id="otro" name="otro">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button id="actualizar" type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    let modalId = "";
    let modalNombre = "";
    let modalApellido = "";
    let modalCedula = "";
    let modalFecha = "";
    let modalTel = "";
    let modalEnt = "";
    let modalTipo = "";
    let modalOtro = "";
    //FUNCIONA MUESTRA LOS DATOS DE LA FILA
    $(document).on("click", ".editarFila", function() {
      let id = $(this).data("id");
      let nombre = $(this).data("nombre");
      let apellido = $(this).data("apellido");
      let cedula = $(this).data("cedula");
      let fecha = $(this).data("fecha");
      let telefono = $(this).data("telefono");
      let entidad = $(this).data("entidad");
      let tipo = $(this).data("tipoatencion");
      let otro = $(this).data("otro");

      // Llenar los campos del formulario en el modal
      $("#id").val(id);
      $("#nombre").val(nombre);
      $("#apellido").val(apellido);
      $("#cedula").val(cedula);
      $("#fecha").val(fecha);
      $("#telefono").val(telefono);
      $("#entidad").val(entidad);
      $("#tipoatencion").val(tipo);
      $("#otro").val(otro);

    if (tipo === "Otro") {
      $("#verotro").show();
    } else {
      $("#verotro").hide();
      $("#otro").val(''); 
    }
    
  });
    //VERIFICA LA CEDULA
    $("#cedula").on("keyup", function(event) {
      var cedula = $("#cedula").val();
      var longitudCedula = cedula.length;

      if (longitudCedula >= 3) {
        var dataString = 'cedula=' + cedula;

        let aviso = document.getElementById("aviso");
        $.ajax({
          url: 'verificar_cedula.php',
          type: "GET",
          data: dataString,
          dataType: "JSON",
          success: function(datos) {
            $("#respuesta").html(datos.message);
            if (datos.success == 1) {
              aviso.className = "alert alert-success";
              aviso.innerHTML = "Cedula validada";
            } else {
              aviso.className = "alert alert-danger";
              aviso.innerHTML = "Cedula no encontrada";
            }
          }
        });
      }
    });

    //_______ NO FUNCIONA REVISAR LOS MOTIVOS _____
    //Validando si existe la Cedula en BD antes de enviar el Form

    let actualizar = document.getElementById('actualizar');

actualizar.addEventListener('click', () => {
    let modalId = $("#id").val();
    let modalNombre = $("#nombre").val();
    let modalApellido = $("#apellido").val();
    let modalCedula = $("#cedula").val();
    let modalFecha = $("#fecha").val();
    let modalTel = $("#telefono").val(); 
    let modalEnt = $("#entidad").val();
    let modalTipo = $("#tipoatencion").val();
    let modalOtro = $("#otro").val();

    let form = new FormData();
    form.append('id', modalId);
    form.append('nombre', modalNombre);
    form.append('apellido', modalApellido);
    form.append('cedula', modalCedula);
    form.append('fecha', modalFecha);
    form.append('telefono', modalTel);
    form.append('entidad', modalEnt);
    form.append('tipoatencion', modalTipo);
    form.append('otro', modalOtro);
    

    fetch("Actualizar.php", {
        method: 'POST',
        body: form
        
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data);
         
        if (data.success) {  
            Swal.fire({
                icon: 'success',
                title: 'Datos capturados con éxito...!!',
                showConfirmButton: false,
                timer: 5000,
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'ERROR',
                html: '<div class="alert alert-danger" role="alert">No se ha podido realizar...!<br>Reintente nuevamente por favor.</div>'
            });
        }
    })
});

  </script>
</body>
</html>