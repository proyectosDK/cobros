<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>

<!-- DATATABLES -->
<script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>    
<script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('datatables/buttons.colVis.min.js')}}"></script>
<script src="{{asset('datatables/jszip.min.js')}}"></script>
<script src="{{asset('datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('datatables/vfs_fonts.js')}}"></script> 

<script src="{{asset('js/bootbox.min.js')}}"></script> 
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!--  -->
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.validate.localization.js') }}"></script>
<script src="{{ asset('js/knockout-3.4.2.js')}}"></script>
<script src="{{asset('js/knockout.mapping.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script> 
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>

<!-- scripts  -->
<script src="{{asset('jsfiles/js/model.js')}}"></script>
<script src="{{asset('jsfiles/js/anio.js')}}"></script>
<script src="{{asset('jsfiles/js/cuota.js')}}"></script>
<script src="{{asset('jsfiles/js/ubicacion.js')}}"></script>
<script src="{{asset('jsfiles/js/tipoUsuario.js')}}"></script>
<script src="{{asset('jsfiles/js/user.js')}}"></script>

<!-- scripts  axios-->
<script src="{{asset('jsfiles/services/anioService.js')}}"></script>
<script src="{{asset('jsfiles/services/cuotaService.js')}}"></script>
<script src="{{asset('jsfiles/services/ubicacionService.js')}}"></script>
<script src="{{asset('jsfiles/services/tipoUsuarioService.js')}}"></script>
<script src="{{asset('jsfiles/services/userService.js')}}"></script>

<script>
	$(document).ready(function () {
	    ko.applyBindings();

	    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>