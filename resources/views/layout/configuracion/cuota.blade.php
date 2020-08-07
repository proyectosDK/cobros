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
                    <h1 class="box-title">Cuotas <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.cuotaController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>cuota</th>
                      <th>limite (litros)</th>
                      <th>cuota extra (por litro)</th>
                      <th>estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.cuotaController.cuotas,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: formatCurrency(parseFloat(cuota).toFixed(2))"></td>
                        <td data-bind="text: limite"></td>
                        <td data-bind="text: formatCurrency(parseFloat(extra).toFixed(2))"></td>
                        <td><span class="label" data-bind="text: (actual === 1 ? 'Activo' : 'Inactivo'), css: (actual === 1 ? 'label-primary' : 'label-danger')"></span></td>
                        <td width="10%">
                          <a href="#" class="btn btn-info btn-xs" data-bind="click: model.cuotaController.cambiarEstado" data-toggle="tooltip" title="activar"><i class="fa fa-eye"></i></a>

                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.cuotaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.cuotaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>cuota</th>
                      <th>limite (litros)</th>
                      <th>cuota extra (por litro)</th>
                      <th>estado</th>
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
                      <h4 data-bind="visible:!model.cuotaController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.cuotaController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.cuotaController.cuota">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">cuota <span class="text-danger"> *</span></label>
                                <input type="number" min="1" step="0.1" id="cuota" name="cuota" placeholder="ingrese cuota" class="form-control"data-bind="value: cuota"
                                     data-error=".errorcuota" required>
                              <span class="errorcuota text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">limite (litros) <span class="text-danger"> *</span></label>
                                <input type="number" step="0.1" id="limite" name="limite" placeholder="ingrese limite" class="form-control"data-bind="value: limite"
                                     data-error=".errorlimite" required>
                              <span class="errorlimite text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">cuota extra (por litros) <span class="text-danger"> *</span></label>
                                <input type="number" step="0.1" id="extra" name="extra" placeholder="ingrese cuota extra" min="0.1" class="form-control"data-bind="value: extra"
                                     data-error=".errorextra" required>
                              <span class="errorextra text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.cuotaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.cuotaController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.cuotaController.initialize();
        });
</script>
@endsection