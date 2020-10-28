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
                    <h1 class="box-title">Cambiar contraseña</h1>
                  <div class="box-tools pull-right">
                  </div>
              </div>

              <div class="body">
                <div class="panel-body">

                  <div class="box">
                    <div class="box-body">
                      
                     <form name="changeForm" id="changeForm" data-bind="with: model.userController.user">
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="text2">Contraseña anterior <span class="text-danger"> *</span></label>
                        <input type="password" id="old_password" name="old_password" placeholder="ingrese contraseña anterior" class="form-control"data-bind="value: old_password"
                             data-error=".errorOldPass"
                             minlength="6" maxlength="25" required>
                      <span class="text-danger errorOldPass help-inline"></span>
                  </div>
                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label for="text2">Nueva contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password" name="password" placeholder="ingrese contraseña" class="form-control"data-bind="value: password"
                                     data-error=".errorPassword"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorPassword help-inline"></span>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label for="text2">Confirmar contraseña <span class="text-danger"> *</span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="confirmar contraseña" class="form-control"data-bind="value: password_confirmation"
                                     data-error=".errorConfirmation"
                                     minlength="6" maxlength="25" required>
                              <span class="text-danger errorConfirmation help-inline"></span>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a class="btn btn-primary btn-sm" data-bind="click:  model.userController.cambiar"><i class="fa fa-save"></i> Cambiar</a>
                          </div>
                </form>
                    </div>
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

<script>
        $(document).ready(function () {
            model.userController.initialize();
        });
</script>
@endsection