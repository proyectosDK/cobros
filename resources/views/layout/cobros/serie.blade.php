@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title">Series comprobantes <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.serieController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>serie</th>
                      <th>número inicio</th>
                      <th>total comprobantes</th>
                      <th>numero actual</th>
                      <th>estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.serieController.series,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: serie"></td>
                        <td data-bind="text: inicio"></td>
                        <td data-bind="text: total"></td>
                        <td data-bind="text: no_actual"></td>
                        <td width="10%" data-bind="text:  (actual == 1 ? 'Activo' : 'Inactivo'), css: (actual == 1 ? 'label-success':'label-danger') ">
                        </td>
                        <td width="10%" data-bind="visible: actual == 1">
                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.serieController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.serieController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>serie</th>
                      <th>número inicio</th>
                      <th>total comprobantes</th>
                      <th>numero actual</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>

              <div class="modal fade" id="nuevo" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 data-bind="visible:!model.serieController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.serieController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.serieController.serie">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">serie <span class="text-danger"> *</span></label>
                                <input type="text" id="serie" name="serie" placeholder="ingrese serie" class="form-control"data-bind="value: serie"
                                     data-error=".errorserie" maxlength="3" minlength="1" required>
                              <span class="errorserie text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">inicio <span class="text-danger"> *</span></label>
                                <input type="number"  id="inicio" name="inicio" placeholder="ingrese inicio" class="form-control"data-bind="value: inicio"
                                     data-error=".errorI" required>
                              <span class="errorI text-danger help-inline"></span>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Total comprobantes <span class="text-danger"> *</span></label>
                                <input type="number"  id="total" name="total" placeholder="ingrese total" class="form-control"data-bind="value: total"
                                     data-error=".errorT" required>
                              <span class="errorT text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.serieController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.serieController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
                          </div>
                        </form>
                    </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
            model.serieController.initialize();
        });
</script>
@endsection