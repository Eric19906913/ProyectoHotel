<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include_once('header.php') ?>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary">
       <button class="navbar-toggler" type="button"
       data-toggle="collapse"
       aria-controls="navbarText"
       aria-expanded="false" aria-label="Toggle navigation">
       <a class="navbar-brand" href="<?php echo base_url('admin') ?>">Salir</a>
       <button class="navbar-toggler" type="button"
       data-toggle="collapse"
       aria-controls="navbarText"
       aria-expanded="false" aria-label="Toggle navigation">
       <a class="navbar-brand" href="<?php echo base_url('admin/consulta') ?>">Consultar Check In</a>
   </nav>
    <div class="container-fluid" id='chekIn'>
    <form id='checkinForm'>
      <div class="form-row">
        <div class="col">
          <label for="InputUser">Nombre</label>
          <input type="text" class="form-control" id="nombre" placeholder="*Nombre" required>
          <label for="InputTelefono">Telefono</label>
          <input type="text" class="form-control" id="telefono" placeholder="*Numero de telefono" required>
          <label for="InputEmail">Correo electronico</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="*Email" required
          pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
          <label for="selectTipohabitacion">Tipo de Habitacion</label><br>
          <select class="form-control" name="Tipohabitacion" id='tipoHabitacion'width=60>
            <option value="Basica">Basica</option>
            <option value="Copada">Copada</option>
            <option value="Presidencial">Presidencial</option>
          </select><a href="#ex1" rel="modal:open"><i class="far fa-edit"></i></a>
        </div>
        <div class="col">
          <label for="InputApellido">Apellido</label>
          <input type="text" class="form-control" id="apellido" placeholder="*Apellido" required>
          <label for="InputDni">Dni</label>
          <input type="text" class="form-control" id="dni" placeholder="*Dni" required>
          <label for="InputIngreso">Fecha de ingreso</label>
          <input type="date" class="form-control" id="fechaIngreso" placeholder="*Fecha de ingreso" required>
          <label for="InputOcupantes">Ocupantes</label>
          <input type="number" class="form-control" id="ocupantes" placeholder="*Cantidad ocupantes" required>
          <br>
        </div>
      </div>
      <center><button type="button" class="btn btn-primary"onclick="CheckIn()">Aceptar</button></center>
      <p id='respuesta'></p>
      <div id="ex1" class="modal">
        <p>Editar cosas del selector (ALGUN DIA)</p>
        <a href="#" rel="modal:close">Close</a>
      </div>
  </body>
  <script>
  function CheckIn(){

    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var telefono = document.getElementById('telefono').value;
    var dni = document.getElementById('dni').value;
    var fechaI = document.getElementById('fechaIngreso').value;
    var email = document.getElementById('email').value;
    var ocupantes = document.getElementById('ocupantes').value;
    var tipoHabitacion = document.getElementById('tipoHabitacion').value;
    if(nombre === "" || apellido === "" || telefono ==="" || dni ==="" || email ==="" || fechaI ==="" || ocupantes ===""){

      document.getElementById('respuesta').innerHTML='<center><strong>Debe completar todos los campos!</strong></center>';

    }else{
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>checkIn_controller/Guardar',
      data:{
        nombre:nombre,
        apellido:apellido,
        telefono:telefono,
        dni:dni,
        fechaI:fechaI,
        email:email,
        ocupantes:ocupantes,
        tipoHabitacion:tipoHabitacion,
      },
      success:function(data){
        swal("Aviso", "Check In realizado con exito", "success");

        document.getElementById('checkinForm').reset();
      },
      error: function(){
        window.alert('Ocurrio un error');
      },
    });

  }
}

  </script>
</html>
