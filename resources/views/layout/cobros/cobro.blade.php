@extends('layout.main_layout')
@section('content')

<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
      <div class="row" data-bind="visible: model.cobroController.gridMode()">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title">Cobros <button class="btn btn-success btn-md" id="btnagregar" data-bind="click: model.cobroController.nuevo" ><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>numero</th>
                      <th>cliente</th>
                      <th>total</th>
                      <th>estado</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody data-bind="dataTablesForEach : {
                            data: model.cobroController.cobros,
                            options: dataTableOptions
                          }">  
                      <tr>
                        <td data-bind="text: serie.serie+'-'+numero"></td>
                        <td data-bind="text: cliente.primer_nombre+' '+cliente.primer_apellido"></td>
                        <td data-bind="text: total"></td>
                        <td width="10%" data-bind="text:  (anulado == 0 ? 'Aceptado' : 'Anulado'), css: (anulado == 0 ? 'label-success':'label-danger') ">
                        </td>
                        <td width="10%">
                            <a class="btn btn-info btn-xs" data-bind="click: model.cobroController.editar" data-toggle="tooltip" title="ver"><i class="fa fa-eye"></i></a>

                            <a data-bind="visible: anulado == 0" href="#" class="btn btn-danger btn-xs" data-bind="click: model.cobroController.destroy" data-toggle="tooltip" title="anular"><i class="fa fa-close"></i></a>
                        </td>
                    </tr>                          
                    </tbody>
                    <tfoot>
                      <th>número</th>
                      <th>total</th>
                      <th>estado</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
              </div>
              <!--Fin centro -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

     <div class="row" data-bind="visible: model.cobroController.insertMode()">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                    <h1 class="box-title">Nuevo cobro # <span data-bind="text: model.cobroController.cobro.serie() + '-'+model.cobroController.cobro.numero()"></span></h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body">
                <div class="row">
                    
                  <form id="formulario" name="formulario" data-bind="with: model.cobroController.cobro">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label for="rol">Cliente <span class="text-danger"> *</span></label>
                          <select id="cliente" class="form-control show-tick selectpicker" data-live-search="true"  
                                  data-bind="selectPicker: true,
                                  optionsText: function(cliente) {return cliente.primer_nombre+ ' '+cliente.segundo_nombre+' '+cliente.primer_apellido+' '+cliente.segundo_apellido},
                                  optionsValue: 'id',
                                  value: cliente_id, 
                                  selectPickerOptions: { optionsArray: model.cobroController.clientes},
                                  optionsCaption: '--selecione cliente--'"
                                  data-error=".errorCliente"
                                  required>
                          </select>
                          <span class="errorCliente text-danger help-inline"></span>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label for="text2">Fecha <span class="text-danger"> *</span></label>
                                  <input type="date" id="fecha" name="fecha" placeholder="ingrese fecha de pago" class="form-control"data-bind="value: fecha"
                                       data-error=".errorF" required>
                                <span class="errorF text-danger help-inline"></span>
                            </div>

                  </form>
                </div>

                
                <div class="row">
                        

                    <form id="form2" data-bind="with: model.cobroController.d_cobro">
                      <h4 class="box-title">Agregar detalle</h4>

                      <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="rol">Anio <span class="text-danger"> *</span></label>
                                <select id="anio" class="form-control show-tick selectpicker" data-live-search="true"  
                                        data-bind="selectPicker: true,
                                        optionsText: function(anio) {return anio.anio},
                                        optionsValue: 'id',
                                        value: anio_id, 
                                        selectPickerOptions: { optionsArray: model.cobroController.anios},
                                        optionsCaption: '--selecione cliente--'"
                                        data-error=".errorAnio"
                                        required>
                                </select>
                                <span class="errorAnio text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for="rol">Mes <span class="text-danger"> *</span></label>
                                <select id="mes" class="form-control show-tick selectpicker" data-live-search="true"  
                                        data-bind="selectPicker: true,
                                        optionsText: function(mes) {return mes.mes},
                                        optionsValue: 'id',
                                        value: mes_id, 
                                        selectPickerOptions: { optionsArray: model.cobroController.meses_activos},
                                        optionsCaption: '--selecione mes--'"
                                        data-error=".errorMes"
                                        required>
                                </select>
                                <span class="errorAnio text-danger help-inline"></span>
                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <label for="text2">Lectura (litros) <span class="text-danger"> *</span></label>
                                    <input type="number" step="0.1" id="limite" name="limite" placeholder="ingrese lectura contador" class="form-control"data-bind="value: lectura"
                                         data-error=".errorTot" required>
                                  <span class="errorTot text-danger help-inline"></span>
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-9">
                                <br />
                                <button data-bind="click: model.cobroController.addDetalle" class="btn btn-success"> <i class="fa fa-plus"></i> agregar</button>
                              </div>
                    </form>  
                </div>

                <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Mes</th>
                                    <th>Lectura (lt)</th>
                                    <th>Extra (lt)</th>
                                    <th>Extra (Q)</th>
                                    <th>total mes</th>
                                    <th width="10%">Opciones</th>
                                    </thead>

                                    <tbody>
                                        <!-- ko foreach: {data: model.cobroController.cobro.detalle, as: 'f'} -->
                                        <tr>
                                            <td data-bind="text: f.mes"></td>
                                            <td data-bind="text: f.lectura"></td>
                                            <td data-bind="text: f.agua_extra"></td>
                                            <td data-bind="text: formatCurrency(parseFloat(f.total_extra).toFixed(2))"></td>
                                            <td data-bind="text: formatCurrency(parseFloat(f.total_mes).toFixed(2))"></td>
                                            <td width="10%">
                                                <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.cobroController.removeDetail" data-toggle="tooltip" title="remover"><i class="fa fa-minus"></i></a>
                                            </td>
                                        </tr>
                                        <!-- /ko -->
                                        <tr data-bind="if: model.cobroController.cobro.detalle().length === 0">
                                            <td colspan="5" class="text-center"> ningun producto agregado</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <h3 class="text-right" data-bind="text:'TOTAL: '+ formatCurrency(parseFloat(model.cobroController.cobro.total()).toFixed(2))"></h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" data-bind="click:  model.cobroController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
                                        <a class="btn btn-danger btn-sm" data-bind="click: model.cobroController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
              </div>
              <!--Fin centro -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row" data-bind="visible: model.cobroController.editMode()">
      <section class="invoice">
                <ol class="breadcrumb pull-right">
                    <li><a href="javascript{0}" data-bind="click: model.cobroController.cancelar">cobros</a></li>
                    <li class="active">Detalle cobro</li>
                </ol>
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i>
                            <small class="pull-right" data-bind="text: moment(model.cobroController.info.fecha()).format('DD/MM/YYYY')"></small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>

                <h3 class="text-center" id="cancel" data-bind="visible: model.cobroController.info.anulado()"> Anulada</h3>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong>Ciudad pedro de alvarado</strong><br>
                            Jutiapa<br>
                            Guatemala<br>
                            Telefono: (502) 58789856<br>
                            Email: info@guatemala.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong data-bind="text: 'cliente: '+ model.cobroController.info.cliente()"></strong><br>
                            <span data-bind="text:'NIT: '+ model.cobroController.info.nit()"></span><br>
                            <span data-bind="text:'CUI: '+ model.cobroController.info.cui()"></span><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b data-bind="text: 'cobro # '+ model.cobroController.info.numero()"></b><br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Anio/Mes</th>
                                    <th>Lectura (lt)</th>
                                    <th>Extra (lt)</th>
                                    <th>Extra (Q)</th>
                                    <th>total mes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ko foreach: {data: model.cobroController.info.detalle, as: 'f'} -->
                                <tr>
                                    <td data-bind="text: f.anio.anio+'/'+f.mes.mes"></td>
                                    <td data-bind="text: f.lectura"></td>
                                    <td data-bind="text: f.agua_extra"></td>
                                    <td data-bind="text: f.total_extra"></td>
                                    <td data-bind="text: formatCurrency(parseFloat(f.total_mes).toFixed(2))"></td>
                                </tr>
                                <!-- /ko -->

                                <tr>
                                    <td colspan="5">
                                        <h3 class="text-right" data-bind="text:'TOTAL: '+ formatCurrency(parseFloat(model.cobroController.info.total()).toFixed(2))"></h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </section>
    </div>
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<script>
        $(document).ready(function () {
            model.cobroController.initialize();
        });
</script>

<style>
    #cancel {
        font: bold 12px Sans-Serif;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: #ea1f1f;
        color: #fff;
        padding: 5px 10px;
        margin: 0 0 10px 0;
        line-height: 24px;
    }
</style>


@endsection