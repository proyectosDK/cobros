@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <section class="content-header">
              <h1>
                <small></small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="clientesView">CLIENTES</a></li>
                <li class="active" data-bind="text: model.estadoController.cliente.nombres()"></li>
              </ol>
            </section>

            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title"> HISTORIAL CLIENTE </h1>
                  <div class="box-tools pull-right">
                  </div><hr />

                  <address data-bind="with: model.estadoController.cliente">
                    <strong>Nombre completo: </strong> <span data-bind="text: nombres"></span><br>
                    <strong>DPI: </strong> <span data-bind="text: cui"></span><br>
                    <strong>NIT: </strong> <span data-bind="text: nit"></span><br>
                    <strong>Edad: </strong> <span data-bind="text: edad"></span> años<br>
                    <strong>Ubicación: </strong> <span data-bind="text: ubicacion"></span><br>
                    <strong>Fecha inicio de servicio: </strong> <span data-bind="text: fecha_inicio"></span><br>
                    <strong>Estado: </strong> <span data-bind="text: estado == 'A' ? 'Activo':'Inactivo', css: estado=='A' ? 'label-success':'label-danger' "></span><br>
                  </address>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">

              </div>

              <!--Fin centro -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
          var url_string = window.location.href
          var url = new URL(url_string);
          var id = url.searchParams.get("id");

          model.estadoController.initialize(id);
        });
</script>
@endsection