
<?php
include_once('header.php');

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Hotel Cinco Soles</title>
   </head>
   <body>
     <nav class="navbar navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <a class="navbar-brand" href="#reserva">Contactenos</a>
        <button class="navbar-toggler" type="button"
        data-toggle="collapse"
        aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <a class="navbar-brand" href="#acercaDe">Acerca de nosotros</a>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="<?php echo base_url() ?>assets/entrada2.jpg" alt="First slide" width="360" height="600">
          <div class="carousel-caption d-none d-md-block">
            <h5>Nuestra ubicacion</h5>
            <p>calle nose cuanto por ahi</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="<?php echo base_url() ?>assets/habitacion.jpg" alt="Second slide" width="360" height="600">
          <div class="carousel-caption d-none d-md-block">
            <h5>Nuestra habitacion</h5>
            <p>gran espacio</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="<?php echo base_url() ?>assets/habitacion2.jpg" alt="Third slide" width="360" height="600">
          <div class="carousel-caption d-none d-md-block">
            <h5>Otra habitacion</h5>
            <p>cosas aca</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>
    <center>

      <h1>Contactenos</h1>
      <div class="container-fluid" id='reserva'>
        <form id='contactForm'>
          <div class="form-row">
            <div class="col">
              <label for="InputUser">Nombre</label>
              <input type="text" class="form-control" id="usuario" placeholder="*Nombre usuario" required>
              <label for="InputTelefono">Telefono</label>
              <input type="text" class="form-control" id="telefono" placeholder="*Ingrese su numero de telefono" required>
              <label for="InputEmail">Correo electronico</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="*Ingrese su Email" required
              pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
            </div>
            <div class="col">
              <label for="InputConsulta">Su consulta</label>
              <textarea class="form-control" id="consulta" rows="4" placeholder="*Ingrese su consulta aqui" required></textarea>
              <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su informacion con nadie</small>
              
              <button type="button" class="btn btn-primary"onclick="Aceptar()">Aceptar</button>
            </div>
          </div>
          <p id='respuesta'></p>
          <br>
    </body>

    <script type="text/javascript">
      function Aceptar(){
        var usuario = document.getElementById('usuario').value;
        var email = document.getElementById('email').value;
        var telefono = document.getElementById('telefono').value;
        var consulta = document.getElementById('consulta').value;

        if(usuario === "" || email === "" || telefono ==="" || consulta ===""){

          document.getElementById('respuesta').innerHTML='<center><strong>Debe completar todos los campos!</strong></center>';

        }else{
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>user_controller/guardar',
            datatype: "jsonp",
            data: { user: usuario,
                    correo: email,
                    phone: telefono,
                    consult: consulta,
                  },
              success:function(data){
                document.getElementById('respuesta').innerHTML='<center><strong>Gracias por su consulta '+usuario+'!</strong><br><small>Le responderemos a la brevedad</small></center>';
                document.getElementById('contactForm').reset();
                //window.setTimeout(function(){//relocalizar con tiempo. pero para que??
                //window.location.assign('eleccion');
                  //}, 3000);
              },
              error:function(){
                window.alert('Nuestro servidor esta fallando.. Disculpe las molestias');
              },

            });
        }
      }

    </script>


   <footer id='acercaDe'>
     <?php include_once('footer.php') ?>
   </footer>
 </html>
