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
      <h3 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">REPORTE DE COBROS DEL {{$inicio != 0 ? date('d-m-Y',strtotime($inicio)) : ''}} AL {{$fin != 0 ? date('d-m-Y',strtotime($fin)): ''}}</h3>
  </head>
  <br />
  <table>
    <thead>
      <tr>
        <th>comprobante</th>
        <th>fecha</th>
        <th>Cliente</th>
        <th>Ubicacion</th>
        <th>Total</th>
      </tr>
    </thead>
    <thead>
      @foreach($cobros as $cobro)
      <tr>
        <td>{{$cobro->serie->serie.'-'.$cobro->numero}}</td>
        <td>{{date('d-m-Y', strtotime($cobro->fecha))}}</td>
        <td>{{$cobro->cliente->primer_nombre.' '.$cobro->cliente->segundo_apellido.' '.$cobro->cliente->primer_apellido.' '.$cobro->cliente->segundo_apellido}}</td>
         <td>{{$cobro->cliente->ubicacion.' '.$cobro->cliente->ubicacion_cliente->nombre}}</td>
        <td>Q {{number_format($cobro->total, 2)}}</td>
      </tr>
      @endforeach
    </thead>
  </table>
</body>
</html>
