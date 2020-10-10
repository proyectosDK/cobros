@extends('layout.main_layout')
@section('content')
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-body">
                    <div class="box-header with-border">
                          <h1 class="box-title">REPORTES </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="box box-success">
                                       
                      <div class="box-header">
                        REPORTE COBROS POR RANGO DE FECHAS
                      </div>
                      <div class="box-body">
                        <form class="form">
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>Fecha inicio</label>
                              <input class="form-control" type="date" id="inicio" name="inicio">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>Fecha fin</label>
                              <input class="form-control" type="date" id="fin" name="fin">
                            </div>
                            <div class="form-group">
                              <br />
                              <a onclick="reporteContros()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"> </i> imprimir</a>
                            </div>
                        </form>
                      </div>
                    </div>

                    <div class="box box-success">
                                       
                      <div class="box-header">
                        REPORTE CLIENTES
                      </div>
                      <div class="box-body">
                        <form class="form">
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <label>Selecciones opción</label>
                              <select class="form-control" id="option_cliente" name="option_cliente">
                                <option value="1">todos</option>
                                <option value="2">activos</option>
                                <option value="3">inactivos</option>
                                <option value="4">deudores</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <br />
                              <a onclick="reporteClientes()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"> </i> imprimir</a>
                            </div>
                        </form>
                      </div>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido--> 


<script>
  function reporteContros(){
    var inicio = $('#inicio').val();
    var fin = $('#fin').val();
    
    if (fin < inicio){
      toastr.error('la fecha fin debe ser menor o igual a la fecha de inicio',"error");
      return;
    }

    if(inicio !== "" & fin==""){
      toastr.error('seleccione fecha fin','error');
      return;
    }

     if(fin !== "" & inicio==""){
      toastr.error('seleccione fecha inicio','error');
      return;
    }

    if(inicio == "" & fin==""){
      inicio = 0;
      fin = 0;
    }

    window.open('reporte_cobros/'+inicio+'/'+fin,'_blank');

    
  }

  function reporteClientes(){
    var option = $('#option_cliente').val();
    window.open('reporte_clientes/'+option,'_blank');
  }
</script>

@endsection

