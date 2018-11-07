<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include_once('header.php') ?>
    <meta charset="utf-8">
    <title>Check In</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary">
       <button class="navbar-toggler" type="button"
       data-toggle="collapse"
       aria-controls="navbarText"
       aria-expanded="false" aria-label="Toggle navigation">
       <a class="navbar-brand" href="<?php echo base_url('admin/CheckIn') ?>">Atras</a>
   </nav>
    <div class="" id='checkinconsulta'>
      <table id="checkin" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Fecha de ingreso</th>
        <th>Ocupantes</th>
        <th>Tipo de Habitacion</th>
        <th style="width:125px;">Acción</th>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

  </body>
  <script>
  var table;
  var save_method;

  jQuery(document).ready(function($){
      table = $('#checkin').DataTable({
          "ajax": {
              url : "<?php echo base_url() ?>checkin_controller/ajax_listado",
              type : 'GET'
          },
          language: {
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
  {
      if(confirm('¿Desea borrar los datos seleccionados?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo base_url('checkin_controller/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  swal("Aviso", "Datos eliminados con éxito.", "success");
                  //if success reload ajax table

                  reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
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
  {
      table.ajax.reload(null,false); //reload datatable ajax
  }
  function relocate(){
    location.href= "<?php echo base_url('admin/consumos') ?>";

  }
  </script>
</html>
