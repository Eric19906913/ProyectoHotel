<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include_once('header.php'); ?>
    <meta charset="utf-8">
    <title>Bienvenido</title>
  </head>
  <body>
     <nav class="navbar navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <a class="navbar-brand" href="#consultas">Consultas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <a class="navbar-brand" href="<?php echo base_url() ?>admin/CheckIn">CheckIn</a>
        <button class="navbar-toggler" type="button"
        data-toggle="collapse"
        aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <a class="navbar-brand" href="<?php base_url() ?>home/index">Salir</a>
    </nav>
    <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-redo"></i>Recargar</button>
    <br>
    <br>
    <div class="" id='consultas'>
      <table id="usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <th>Nombre</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>Consulta</th>
        <th style="width:125px;">Acción</th>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>


  </body>
  <script type="text/javascript">
  var table;
  var save_method;

  jQuery(document).ready(function($){
      table = $('#usuarios').DataTable({
          "ajax": {
              url : "<?php echo base_url() ?>consulta_controller/ajax_listado", //accede al controlador para crear la Datatable
              type : 'GET'
          },
          language: {//se le pasa un JSON con el "Lenguaje" para cada situacion
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
      });
  });
  function delete_consulta(id)
  {//funcion para borrar consultas
      if(confirm('¿Desea borrar la consulta?'))
      {
          $.ajax({
              url : "<?php echo base_url('consulta_controller/ajax_delete')?>/"+id, // accede al controlador pasand como parametro el id
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  swal("Aviso", "Consulta eliminada con éxito.", "success");
                  //aviso de exito

                  reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              { // aviso si ocurre un error
                  var mensaje = "Error borrando la consulta";
                  if(jqXHR.responseText){
                      mensaje = jqXHR.responseText;
                  }
                  if(mensaje != ""){
                      swal("Aviso", mensaje, "warning");
                  }
              }
          });

      }
  }
  function reload_table()
  {//
      table.ajax.reload(null,false); //recarga Datatable
  }

  </script>
</html>
