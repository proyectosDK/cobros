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
                    <h1 class="box-title">Clientes <button class="btn btn-success btn-md" id="btnagregar" data-toggle="modal" data-target="#nuevo" data-bind="model.clienteController.clearData()" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Cui</th>
                      <th>Cliente</th>
                      <th>Ubicación</th>
                      <th>Fecha inició</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.clienteController.clientes,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td  data-bind="text: cui"></td>
                        <td data-bind="text: primer_nombre+' '+segundo_nombre+' '+primer_apellido+' '+segundo_apellido "></td>
                        <td data-bind="text: ubicacion_cliente.nombre"></td>
                        <td width="15%" data-bind="text: moment(fecha_inicio).format('DD/MM/YYYY')"></td>
                        <td width="10%" data-bind="text:  (estado == 'A' ? 'Activo' : 'Inactivo'), css: (estado == 'A' ? 'label-success':'label-danger') ">
                        </td>

                        <td width="10%">
                          <a data-bind="attr: {href: 'historial?id=' +id }" class="btn btn-info btn-xs" data-bind="click: model.clienteController.editar" data-toggle="tooltip" title="historial"><i class="fa fa-file"></i></a>

                            <a data-toggle="modal" data-target="#nuevo" href="#" class="btn btn-warning btn-xs" data-bind="click: model.clienteController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.clienteController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>Cui</th>
                      <th>Cliente</th>
                      <th>Ubicación</th>
                      <th>Fecha inició</th>
                      <th>Estado</th>
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
                      <h4 data-bind="visible:!model.clienteController.editMode()" class="modal-title"> Nuevo Registro</h4>
                      <h4 data-bind="visible:model.clienteController.editMode()" class="modal-title"> Editar Registro</h4>
                    </div>
                    <div class="modal-body">
                      <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" data-bind="with: model.clienteController.cliente">

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Cui <span class="text-danger"> *</span></label>
                                <input type="text" id="cui" name="cui" placeholder="ingrese cui" class="form-control"data-bind="value: cui"
                                     data-error=".errorCui" maxlength="13" minlength="13" required>
                              <span class="errorCui text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Nit </label>
                                <input type="text" id="nit" name="nit" placeholder="ingrese nit" class="form-control"data-bind="value: nit"
                                     data-error=".errorNit" maxlength="10">
                              <span class="errorNit text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Primer nombre <span class="text-danger"> *</span></label>
                                <input type="text"  id="primer_nombre" name="primer_nombre" placeholder="ingrese primer nombre" class="form-control"data-bind="value: primer_nombre"
                                     data-error=".errorPN" required>
                              <span class="errorPN text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Segundo nombre</label>
                                <input type="text"  id="segundo_nombre" name="segundo_nombre" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: segundo_nombre">
                          </div>

                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Primer apellido <span class="text-danger"> *</span></label>
                                <input type="text"  id="primer_apellido" name="primer_apellido" placeholder="ingrese primer apellido" class="form-control"data-bind="value: primer_apellido"
                                     data-error=".errorPA" required>
                              <span class="errorPA text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Segundo apellido</label>
                                <input type="text"  id="segundo_apellido" name="segundo_apellido" placeholder="ingrese segundo apellido" class="form-control"data-bind="value: segundo_apellido">
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Fecha nacimiento <span class="text-danger"> *</span></label>
                                <input type="date"  id="fecha_nac" name="fecha_nac" class="form-control"data-bind="value: fecha_nac"
                                     data-error=".errorFn" required>
                              <span class="errorFn text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for="rol">Genero <span class="text-danger"> *</span></label>
                                <select class="form-control" id="rol" data-bind="options: model.clienteController.generos, optionsText: 'nombre', optionsValue: 'valor',
                                 optionsCaption: '--seleccione--',
                                 value: genero" 
                                 data-error=".errorGenero"
                                required></select>
                                <span class="errorU text-danger help-inline"></span>
                              </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text2">Fecha inicio servicio <span class="text-danger"> *</span></label>
                                <input type="date"  id="fecha_inicio" name="fecha_inicio" class="form-control"data-bind="value: fecha_inicio"
                                     data-error=".fecha_inicio" required>
                              <span class="fecha_inicio text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for="rol">Aldea o sector <span class="text-danger"> *</span></label>
                                <select id="ubicaion_id" class="form-control show-tick selectpicker" data-live-search="true"  
                                        data-bind="selectPicker: true,
                                        optionsText: function(ubicacion) {return ubicacion.nombre},
                                        optionsValue: 'id',
                                        value: ubicacion_id, 
                                        selectPickerOptions: { optionsArray: model.clienteController.ubicaciones},
                                        optionsCaption: '--selecione aldea o sector--'"
                                        data-error=".errorU"
                                        required>
                                </select>
                                <span class="errorU text-danger help-inline"></span>
                              </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label for="text2">Dirección <span class="text-danger"> *</span></label>
                                <input type="text"  id="ubicacion" name="ubicacion" placeholder="ingrese dirección especifica, como barrio, colonia, lote, etc" class="form-control"data-bind="value: ubicacion"
                                     data-error=".errorUbica" required>
                              <span class="errorUbica text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4">
                            <label> telefonos</label>
                            <div class="input-group input-group-md">
                              <input type="text" class="form-control" data-bind="value: telefono">
                                  <span class="input-group-btn">
                                    <button data-bind="click: model.clienteController.addTelefono" type="button" class="btn btn-success btn-flat"> <i class="fa fa-plus"></i></button>
                                  </span>
                            </div>
                        </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label> telefonos agregados</label>
                            <table class="table table-responsive table-bordered table-hover">
                              <thead class="box box-primary">
                                <tr>
                                  <th>Telefono</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!-- ko foreach: {data: model.clienteController.cliente.telefonos, as: 'a'} -->
                                <tr>
                                  <td data-bind="text: a.numero"></td>
                                  <td><a href="#" class="btn btn-danger btn-xs" data-bind="click: model.clienteController.removeTelefono" data-toggle="tooltip" title="remover"><i class="fa fa-minus"></i></a></td>
                                </tr>
                                <!-- /ko -->
                                <tr data-bind="if: model.clienteController.cliente.telefonos().length === 0">
                                  <td class="text-center"> ningun telefono agregado</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.clienteController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                            <a class="btn btn-danger btn-sm" data-bind="click: model.clienteController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.clienteController.initialize();
        });
</script>
@endsection