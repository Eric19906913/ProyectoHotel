<?php include_once('header.php')

/*
#Este es el login que todavia no esta implementado!!

*/







?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      body{
        margin-top: 100;
        padding-bottom: 50;
        background-image: url(<?php echo base_url('assets/fotobasavilbaso.jpg')?>);
        background-repeat: no-repeat;
        background-size: cover;
        font-family: Verdana;


      }
      input{
        font-family: times;
        font-size: 15px;
      }
      h1{

        border-bottom: rgba(255, 56, 0, 0.5);
        color: rgba(255, 255, 255, 0.3);
      }
    </style>

    <meta charset="utf-8">
    <title>Login Administrador</title>
  </head>
  <body>
    <center>
    <h1>Login Administrador</h1>

    <div class="container-fluid" id=''>
      <form id='AdminForm'>

        <input type="text" value="" placeholder="Ingrese nombre de Usuario" width="60px" id='usuario'>
        <br>
        <input type="password" value=""placeholder="Ingrese su Password" width="60px"id='contraseña'>
        <br>
        <input type="submit" name="" value="Ingresar" onclick="UsuarioA()">
      </form>
    </div>
  </center>
  </body>
  <footer>
    <script>
      function UsuarioA(){
        var usuario = document.getElementById('usuario').value;
        var contraseña = document.getElementById('contraseña').value;
        $.ajax({
          type: 'POST',
          url: 'userA_Controller/UsuarioA',
          data{
            usuario:usuario,
            contraseña:contraseña
          },
          success: function{
            alert('es el usuario');

          },
          error:function{
            alert('no anda nada');
          },

        });
      }

    </script>
  </footer>
</html>
