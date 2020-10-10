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
                          <h1 class="box-title">Dashboard </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                                         
                      <div class="text-center">
                          <div class="row">
                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                  <div class="inner">
                                    <h3 id="clientes"></h3>

                                    <p>Clientes activos</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-user"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                  <div class="inner">
                                    <h3 id="cli_act"></h3>

                                    <p>Clientes inactivos</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-user"></i>
                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                  <div class="inner">
                                    <h3 id="cli_d"></h3>

                                    <p>Clientes deudores</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-user"></i>
                                  </div>
                                </div>
                              </div>

                               <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                  <div class="inner">
                                    <h3 id="cob"></h3>

                                    <p>Cobros </p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-calculator"></i>
                                  </div>
                                </div>
                              </div>
                              <!-- ./col -->
                              </div>


                              <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <div class="box box-info">
                                      <div class="box-header">
                                        Cobros ultimos 12 meses
                                      </div>
                                      <div class="box-body">
                                        <canvas id="cobrosMeses"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                  <div class="box box-info">
                                    <div class="body">
                                      <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>mes/año</th>
                                            <th>Cobros</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <!-- ko foreach: {data: model.cobroController.info_cobros, as: 'c'} -->
                                                  <tr>
                                                      <td data-bind="text: label"></td>
                                                      <td data-bind="text: formatCurrency(parseFloat(value,2))"></td>
                                                  </tr>
                                                  <!-- /ko -->
                                              </tbody>              
                                     </table>
                                    </div>
                                  </div>
                                </div>

                                <!--GRAFICA COBROS POR AÑO -->

                                <div class="col-lg-8 col-md-8">
                                    <div class="box box-info">
                                      <div class="box-header">
                                        Cobros ultimos 12 años
                                      </div>
                                      <div class="box-body">
                                        <canvas id="cobrosAnios"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                  <div class="box box-info">
                                    <div class="body">
                                      <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>año</th>
                                                        <th>Cobros</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                      <!-- ko foreach: {data: model.cobroController.info_cobros_anios, as: 'c'} -->
                                                              <tr>
                                                                  <td data-bind="text: label"></td>
                                                                  <td data-bind="text: formatCurrency(parseFloat(value,2))"></td>
                                                              </tr>
                                                              <!-- /ko -->
                                                          </tbody>              
                                                 </table>
                                    </div>
                                  </div>
                                </div>

                                    <div class="col-lg-6 col-md-6">
                                      <div class="box box-info">
                                        <div class="box-header">
                                          Clientes por ubicación
                                        </div>
                                        <div class="box-body">
                                          <canvas id="ubicacionChart"></canvas>
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-lg-6 col-md-6">
                                      <div class="box box-info">
                                        <div class="box-header">
                                          Clientes deudores por ubicación
                                        </div>
                                        <div class="box-body">
                                          <canvas id="ubicacionDeudoresChart"></canvas>
                                        </div>
                                      </div>
                                  </div>
                              </div>

                              <!-- ./col -->
                            </div>
                        </div>

                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido--> 

<script src="{{ asset('js/Chart.min.js') }}"></script>

<script>
  var colors = ['#3FBF7F','#ED1C11','#161C19','#201C9B','#BF3F3F','#BF7F3F','#BF3FBF','#5E0B07','#B9B6B6','#2F272D','#987654'];

  $(document).ready(function () {
    $.get('/dashboard/info', function(data){
            document.getElementById("clientes").innerHTML = data.clientes;
            document.getElementById("cli_act").innerHTML = data.inactivos;
            document.getElementById("cli_d").innerHTML = data.deudores;
            document.getElementById("cob").innerHTML = data.total_cobros;
        });

    $.get('/dashboard/cobrosMeses', function(data){
          lineChart(data,'cobrosMeses');
          var table = [];
            for(var $i = 0; $i<data.info.length; $i++){
              table.push({
                label: data.labels[$i],
                value: data.info[$i]
              });
            }
            model.cobroController.info_cobros(table)
      });

    $.get('/dashboard/cobrosAnios', function(data){
          lineChart(data,'cobrosAnios');
          var table = [];
            for(var $i = 0; $i<data.info.length; $i++){
              table.push({
                label: data.labels[$i],
                value: data.info[$i]
              });
            }
            model.cobroController.info_cobros_anios(table)
      });

      $.get('/dashboard/ubicacion', function(data){
          pieChart(data,'ubicacionChart');
      });

      $.get('/dashboard/ubicacionDeudores', function(data){
          pieChart(data,'ubicacionDeudoresChart');
      });
  });

  function barChart(data,id_html){
    var ctx = document.getElementById(id_html).getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: data.labels.reverse(),
            datasets: [{
                label: 'Año/Mes',
                backgroundColor: colors,
                borderColor: 'rgb(255, 255, 255)',
                data: data.info.reverse()
            }]
        },

        // Configuration options go here
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                            //steps: 10,
                            stepValue: 1,
              }
            }]
          }
        }
    });
  }

  function pieChart(data,id_html){
    var ctx = document.getElementById(id_html).getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Ubicaciones',
                backgroundColor: colors,
                //borderColor: 'rgb(255, 255, 255)',
                data: data.info
            }]
        }
    });
  }


  function lineChart(data,id_html){
    var ctx = document.getElementById(id_html).getContext('2d');
    let chart = new Chart(ctx, {
      type: 'line',
      data: {
          datasets: [{
              label: 'Cobros',
              data: data.info.reverse()
          }],
          labels: data.labels.reverse()
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 50,
                      suggestedMax: 100
                  }
              }],
              xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 90
                }
            }]
          }
      }
    });
  }
</script>

@endsection

