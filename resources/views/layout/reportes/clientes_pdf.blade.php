<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    <title>reporte</title>
    <style>
      table {
        width:100% !important;
      }
      th {
        background-color: #C7D0E3;
        color: black;
      }
      table, th, td {

      }
    </style>
</head>
<body>
  <head>
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;"> CIUDAD PEDRO DE ALVARADO</h2>
      <h3 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">REPORTE DE CLIENTES {{$option}}</h3>
  </head>
  <br />
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Cliente</th>
        <th>Ubicacion</th>
        <th>Meses atrasados</th>
        <th>estado</th>
      </tr>
    </thead>
    <thead>
      @foreach($clientes as $cliente)
      <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$cliente->primer_nombre.' '.$cliente->segundo_apellido.' '.$cliente->primer_apellido.' '.$cliente->segundo_apellido}}</td>
        <td>{{$cliente->ubicacion.' '.$cliente->ubicacion_cliente->nombre}}</td>
        <td>{{$cliente->meses_atrasados}}</td>
        <td>{{$cliente->estado == 'A' ? 'ACTIVO' : 'INACTIVO'}}</td>
      </tr>
      @endforeach
    </thead>
  </table>
</body>
</html>
