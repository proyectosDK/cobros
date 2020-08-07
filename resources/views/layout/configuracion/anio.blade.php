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
                    <h1 class="box-title">Años <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.anioController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>anio</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.anioController.anios,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: anio"></td>
                        <td width="10%">
                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.anioController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.anioController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>anio</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>

              <div class="modal fade" id="nuevo" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 data-bind="visible:!model.anioController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.anioController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.anioController.anio">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="text2">anio <span class="text-danger"> *</span></label>
                                <input type="text" id="anio" name="anio" placeholder="ingrese anio" class="form-control"data-bind="value: anio"
                                     data-error=".erroranio"
                                     minlength="3" maxlength="25" required>
                              <span class="erroranio text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.anioController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.anioController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.anioController.initialize();
        });
</script>
@endsection