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

                  <strong>INFORMACION: </strong><br>
                  <address data-bind="with: model.estadoController.cliente">
                    <strong>Nombre completo: </strong> <span data-bind="text: nombres"></span><br>
                    <strong>DPI: </strong> <span data-bind="text: cui"></span><br>
                    <strong>NIT: </strong> <span data-bind="text: nit"></span><br>
                    <strong>Edad: </strong> <span data-bind="text: edad"></span> años<br>
                    <strong>Ubicación: </strong> <span data-bind="text: ubicacion"></span><br>
                    <strong>Fecha inicio de servicio: </strong> <span data-bind="text: fecha_inicio"></span><br>
                    <strong>Estado: </strong> <span data-bind="text: estado() == 'A' ? 'Activo':'Inactivo', css: estado()=='A' ? 'label-success':'label-danger' "></span><br>
                  </address>

                  <hr />
              </div>
              <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#estado">Estados</a></li>
                  <li><a data-toggle="tab" href="#cobros">Cobros</a></li>
                </ul>

                <div class="tab-content">
                  <div id="estado" class="tab-pane fade in active">
                    <div class="box-header with-border">
                          <h3> Cambiar estado</h3>
                          
                      </div>
                    <form id="formulario" class="form" data-bind="with: model.estadoController.estado">
                      <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <label for="rol">Acción <span class="text-danger"> *</span></label>
                            <select class="form-control" id="rol" data-bind="options: model.estadoController.estadosAction, optionsText: 'nombre', optionsValue: 'valor',
                             optionsCaption: '--seleccione acción--',
                             value: estado" 
                             data-error=".errorEstado"
                            required></select>
                            <span class="errorEstado text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-4 col-xs-4">
                            <label for="text2">Fecha <span class="text-danger"> *</span></label>
                                <input type="date"  id="fecha_nac" name="fecha" class="form-control"data-bind="value: fecha"
                                     data-error=".errorFn" required>
                            <span class="errorFn text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="text2">Razón <span class="text-danger"> *</span></label>
                                <input type="text"  id="observaciones" name="observaciones" class="form-control"data-bind="value: observaciones"
                                     data-error=".errorOb" minlength="5" maxlength="255" required>
                            <span class="errorOb text-danger help-inline"></span>
                        </div>
                        <div class="form-group col-md-12">
                          <a class="btn btn-primary btn-sm pull-right" data-bind="click:  model.estadoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                        </div>

                  </form>


              <div class="panel-body table-responsive" id="listadoregistros">
                <div class="box-header with-border">
                  <h1 class="box-title"> HISTORIAL </h1>
                </div>
                <ul class="timeline">
                  <!-- ko foreach: {data: model.estadoController.estados, as: 'e'} -->
                  <li class="time-label">
                      <span data-bind="text: e.fecha, css: e.class"></span>
                  </li>
                  <li>
                      <i data-bind="css: e.icon"></i>
                      <div class="timeline-item">
                        <span data-bind="visible: e.delete" class="time" data-toggle="tooltip" title="eliminar acción">
                          <a class="btn btn-danger btn-xs" data-bind="click: model.estadoController.destroy">
                            <i class="fa fa-minus"></i><span class="text-danger">
                          </a>
                        </span>
                          <h3 class="timeline-header"><a data-bind="text: e.estado_name"> </a> ...</h3>
                          <div class="timeline-body" data-bind="text: e.observacion">
                              
                          </div>
                      </div>
                  </li>
                   <!-- /ko -->

                  <!-- timeline time label -->
                  <li class="time-label">
                      <span class="bg-green" data-bind="text: model.estadoController.cliente.fecha_inicio()">
                      </span>
                  </li>
                  <!-- /.timeline-label -->

                  <!-- timeline item -->
                  <li>
                      <!-- timeline icon -->
                      <i class="fa fa-calendar bg-blue"></i>
                      <div class="timeline-item">
                         <!-- <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->

                          <h3 class="timeline-header"><a>Inicio servicio</a> ...</h3>

                          <div class="timeline-body">
                              inicio servicio de cliente
                          </div>

                         <!--  <div class="timeline-footer">
                              <a class="btn btn-primary btn-xs">...</a>
                          </div>-->
                      </div>
                  </li>
                  <!-- END timeline item -->

                  ...

              </ul>
              </div>
                  </div>
                  <div id="cobros" class="tab-pane fade">
                    <div class="panel-body">
                      <h3>Historial cobros</h3>
                      <table id="tbllistado2" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>numero</th>
                      <th>fecha</th>
                      <th>total</th>
                      <th>estado</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.estadoController.cobros,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: serie.serie+'-'+numero"></td>
                        <td data-bind="text: moment(fecha).format('DD/MM/YYYY')"></td>
                        <td data-bind="text: formatCurrency(parseFloat(total).toFixed(2))"></td>
                        <td width="10%" data-bind="text:  (anulado == 0 ? 'Aceptado' : 'Anulado'), css: (anulado == 0 ? 'label-success':'label-danger') ">
                        </td>
                    </tr>                          
                    </tbody>
                  </table>
                    </div>
                  </div>
                </div>
              
              <!-- /.box-header -->
              <!-- centro -->

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