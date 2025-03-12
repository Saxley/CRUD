<!DOCTYPE html>
<html lang="es">
<head>
  <title>Innovación tecnológica</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="./img/innovacion.ico">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.1/dist/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.1/dist/sweetalert2.all.min.js"></script>

  <style>
    * {
      text-decoration: none;
      color: black;
      box-sizing: border-box;
      font-family: 'Open Sans', sans-serif;
      list-style: none;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: rgb(255, 255, 255) !important;
    }
    .flex-container {
      display: flex;
      justify-content: center;
      text-align: center;
      align-items: center;
    }

    .img-1,
    .img-2, .img-fluid {
      width: 130px;
      height: 140px;
      background-color: transparent;
    }
    .background-container {
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    .background-container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url("img/backheaderr.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      opacity: 0.5;
      z-index: -1;
    }

    .navbar {
      position: relative;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      background-color: rgba(12, 12, 13, 0.8);
      height: 60px;
      padding: 0 15px;
      transition: background-color 0.3s ease;
    }
    .nav-link {
      color: #fff;
    }
    .navbar-nav {
      margin-left: auto;
    }

    .content {
      padding: 16px;
    }
    .sticky {
      position: fixed;
      top: 0;
      width: 100%;
      background-color: rgba(51, 51, 51, 0.9);
      color: white;
    }

    @media screen and (max-width: 600px) {
      .d-flex:not(:first-child) {
        display: none;
      }

      .navbar-expand .icon {
        float: right;
        display: block;
      }
    }

    @media screen and (max-width: 600px) {
      .navbar.navbar-expand-lg.responsive {
        position: relative;
      }

      .navbar-expand-lg.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
      }

      .navbar,
      .d-flex.responsive {
        float: none;
        display: block;
      }
    }
    .sticky + .content {
      padding-top: 60px;
    }

    .img-flex {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 30%;
      height: 20%;
    }
    .cancelbtn {
      background-color: red;
    }
    .modal-cont {
      position: fixed;
      height: 100%;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.47);
      top: 0;
      left: 0;
      display: none;
      z-index: 1;
    }

    .modal-box {
      width: 25%;
      position: absolute;
      top: 30%;
      left: 50%;
      transform: translateX(-50%);
      background-color: white;
      text-align: center;
      padding: 0;
      animation-name: zoom;
      animation-duration: .7s;
      border: 1px solid #b7b7b7;
      border-radius: 4px;
      box-shadow: 1px 1px 8px rgba(35, 120, 204, 0.8);
    }

    .modal-box .close {
      position: absolute;
      right: 16px;
      top: 5px;
      font-size: 25px;
      font-weight: bolder;
      cursor: pointer;
    }

    .modal-box .close:hover,
    .modal-box .close:focus {
      color: #c6c6c6;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      border: 1px solid #d0d0d0;
      display: block;
      padding: 8px;
      margin: 5px 0;
      margin-bottom: 10px;
    }

    .modal-box {
      padding: 10px;
      font-size: 15px;
      display: block;
      color: white;
      margin: 16px 0;
    }
    .logear {
      padding: 10px;
      transform: translateX(10%);
      font-size: 15px;
      display: block;
      width: 80%;
      color: white;
      background-color: #0476c4;
      margin: 0;
      cursor: pointer;
    }

    .modal-box label,
    .modal-box input {
      width: 95%;
      display: block;
      margin: 10px auto;
    }

    .modal-box .close-forgot {
      width: 100%;
      padding: 5px 5%;
    }

    .modal-box .cancel {
      background-color: #c44f4f;
      padding: 10px 15px;
      font-size: 15px;
      color: white;
      cursor: pointer;
    }

    .modal-box span {
      float: right;
    }

    .modal-box a {
      color: #1483be;
      font-weight: 500;
      text-decoration: underline;
    }
    .login {
      background-color: #f2f1f1;
      color: rgb(22, 21, 21);
      padding: 10px 15px;
      border-radius: 5%;
      cursor: pointer;
      margin-bottom: 5px;
      opacity: 0.8;
      position: absolute;
      right: 16px;
    }

    h1,
    .login {
      margin: 20px;
      text-align: center;
      display: block;
      margin-top: 20px;
    }

    .round {
      border-radius: 5px;
    }

    input[type=number] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .border {
      background-color: #f4f4f4;
    }

    .container {
      position: relative;
      overflow: hidden;
      width: 100%;
      margin: auto;
      margin-top: 100px;
      background-size: cover;
      background-attachment: fixed;

    }

    .row {
      width: 70%;
      margin: auto;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    label {
      display: block;
      margin: 10px 0 5px;
    }


    input[type=reset] {
      width: auto;
      color: #ffffff;
      padding: 10px 18px;
      background-color: #C61D20;
    }
    .registro {
      width: 100%;
      padding: 10px;
      background-color: #1C76C6;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }


    .card-footer {
      background-color: #448d2d;
      font-size: 16px;
      line-height: 1.6;
    }
    .card-footer .footer {
      color: white;
    }

    @media only screen and (min-width: 576px) {
      .container {
        width: 540px;
      }
    }

    @media only screen and (min-width: 1200px) {
      .container {
        width: 1140px;
      }
    }
    @media screen and (max-width: 600px) {
      .col-12 input[type=aceptar] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>
<body>
  <div class="flex-container">
    <div class="flex-item-left">
      <img src="./img/UP.png" alt="Logo" class="img-1">
    </div>
    <div class="flex-item-center">
      <img src="./img/LogoCrua.png" alt="Logo" class="img-2">
    </div>
    <div class="flex-item-right">
      <img src="./img/innovacionn.png" alt="#" class="img-fluid">
    </div>
  </div>
  <div class="text-center">
    <h2>DEPARTAMENTO DE INNOVACIÓN TECNLÓGICA</h2>
  </div>
  <nav id="navbar" class="navbar navbar-expand-lg navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#" id="addbtn" data-bs-toggle="modal" data-bs-target="#add">Administrador</a>
      </li>
    </ul>
  </nav>
  <div class="modal-cont">
    <div class="modal-box">
      <span class="close">&times;</span>
      <form id="login">
    <h1> Acceso </h1>
        <label for="user" class="form-label">Nombre de Usuario</label>
    <input type="text" id="user" name="user" class="user" placeholder="*Introduzca el usuario" required>
        <label for="password" class="form-label">Contraseña</label>
    <input type="password" id="password" name="password" class="password" placeholder="*Introduzca clave de acceso" required>
        <button type="submit" id="btnLogin" class="logear">Entrar</button>
    <div id="respuesta"></div> 
    <div class="close-forgot">
        <button type="button" class="cancel">Cancelar</button>
    </div>
</form>
    </div>
  </div>
  <div class="background-container">
    <div class="container">
      <div class="row">
        <form id="registro">
          <div class="p-3 border round">
            <h1>FORMULARIO DE CONTROL DE ATENCIÓN</h1>
            <br><br>
            <div class="col-12">
              <label for="nombre" class="form-label">Nombre</label>
              <input id="nombre" type="text" name="nombre" placeholder="*Nombre" required />
          </div>
          <div class="col-12">
            <label for="apellido" class="form-label">Apellido</label>
            <input id="apellido" type="text" name="apellido" placeholder="*Apellido" required />
        </div>
        <div class="col-12">
          <label for="cedula" class="form-label">Cédula</label>
          <input id="cedula" type="text" name="cedula" placeholder="*Cédula" required />
          <p id="mensaje" style="color: orange; font-size: 14px;"></p>
      </div>
      <div class="col-12">
        <label for="fecha" class="form-label">Fecha</label>
        <input id="fecha" type="date" name="fecha" placeholder="*Fecha" required />
    </div>
    <div class="col-12">
      <label for="telefono" class="form-label">Teléfono</label>
      <input id="telefono" type="tel" name="telefono" placeholder="*Teléfono" required />
  </div>
  <div class="col-12">
    <label for="entidad" class="form-label">Entidad</label>
    <select id="entidad" class="form-select" name="entidad">
      <option value="" disabled selected>Seleccione la entidad</option>
      <option value="Estudiante">Estudiante</option>
      <option value="Administrativo">Administrativo</option>
      <option value="Profesor">Profesor</option>
    </select>
  </div>
  <div class="col-sm-12">
    <label for="tipoatencion">Tipo de atención:</label>
    <select id="tipoatencion" name="tipoatencion" onchange="funcion_otro();">
      <option value="" disabled selected>Seleccione el tipo atención</option>
      <option value="Cima-Crua-Moodle">Cima-Crua-Moodle</option>
      <option value="Up-Virtual">Up-Virtual</option>
      <option value="Otro">Otro</option>
    </select>
    <div id="verotro">
      Agregue el tipo de atención:
      <input type="text" name="otro" id="otro">
    </div>
  </div>
  <input type="reset" value="Limpiar">
  <div class="modal-footer">
    <button type="submit" class="registro" id="btnEnviar">Guardar</button>
  </div>
</div>
</form>
</div>
</div>
</div>

<div class="card text-center">
<div class="card-body">
<p class="card-text">
Universidad de Panamá
<br>
Centro Regional Universitario de Azuero
<br>
Designed by
<a href="#">Departamento de innovación tecnológica</a>
</p>
</div>
<div class="card-footer text-body-secondary">
<footer>
&copy; Copyright 2024. Todos los derechos reservados
</footer>
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
// When the user scrolls the page, execute myFunction
window.onscroll = function() {
myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
if (window.scrollY >= sticky) {
navbar.classList.add("sticky")
} else {
navbar.classList.remove("sticky");
}
}

var verotro = document.getElementById("verotro");
verotro.style.display = "none";

function funcion_otro() {
var otro = document.getElementById("tipoatencion").value;

if (otro == "Otro") {
verotro.style.display = "block";
} else {
verotro.style.display = "none";
}
}

var closeBut = document.getElementsByClassName('close')[0],
modal = document.getElementsByClassName('modal-cont')[0],
cancelBut = document.getElementsByClassName('cancel')[0],
loginBut = document.getElementsByClassName('login')[0];


btn = document.getElementById("addbtn");

btn.onclick = function() {
modal.style.display = "block";
};

cancelBut.onclick = function() {
modal.style.display = "none";
};
closeBut.onclick = function() {
modal.style.display = "none";
};
window.onclick = function(event) {
if (event.target === modal) {
modal.style.display = "none";
}
};
$("#modal-cont").click(function() {
$('#modal-box').modal({
backdrop: 'static', keyboard: false
})
});

// Función para iniciar sesión
$('#login').submit(function(event) {
    event.preventDefault();

    var user = $.trim($("#user").val());
    var password = $.trim($("#password").val());

    if (user.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Debe ingresar un usuario',
            color: "#716add",
            background: "#fff",
            backdrop: `rgba(252, 255, 210, 0.4) left top no-repeat`
        });
        return false;
    }

    if (password.length < 5) {
        Swal.fire({
            icon: 'warning',
            title: 'Debe ingresar una contraseña válida',
            color: "#716add",
            background: "#fff",
            backdrop: `rgba(252, 255, 210, 0.4) left top no-repeat`
        });
        return false;
    }

    // Enviar datos al servidor
    $.ajax({
        url: 'usuario.php',
        type: 'POST',
        data: {
            user: user, 
            password: password
        },
        success: function(response) {
            console.log('Respuesta del servidor:', response.trim());
            var res = response.trim();

            if (res !== "success") {
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario o contraseña incorrectos',
                    color: "#d08778",
                    background: "#fff",
                    backdrop: `rgba(255, 0, 0, 0.4) left top no-repeat`
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡BIENVENIDO/A!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ingresar',
                    color: "#d08778",
                    background: "#fff",
                    backdrop: `rgba(34, 139, 34, 0.5) left top no-repeat`
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "mostrar.php";
                    }
                });
            }
        },
    });

    return false;
});

$('#registro').submit(function(event) {
    event.preventDefault();

    // Recopilación de las variables
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var cedula = $("#cedula").val();
    var fecha = $("#fecha").val();
    var tel = $("#telefono").val();
    var entidad = $("#entidad").val();
    var tipoatencion = $("#tipoatencion").val();
    var otro = $("#otro").val() || ""; 

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
                          '<b>Otro:</b> ' + data['otro']
                }).then(function() {
                    location.reload(); 
                });
            } else {
                // Si ocurre un error
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    html: '<div class="alert alert-Warning" role="alert">' + response.message + '</div>'
                });
            }
        },
    });
});

</script>
</body>
</html>