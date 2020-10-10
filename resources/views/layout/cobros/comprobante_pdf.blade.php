<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}
            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}
            h1 small{display:block;font-size:16px;color:#888;}
            table{width:100%;}
            .text-right{text-align:right;}
            #imagen {
                width: 100px;
            }
            #anulado {
                color: rgba(255, 0, 0, 0.5);
                -webkit-transform: rotate(-45deg); 
                -moz-transform: rotate(-45deg);    
                width:100px; text-align: center; position: relative; float: left; width: 100%
            }
        </style>
    </head>
    <body>

    <div class="header">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="80%">
                    <h1>
                        Comprobante # {{ str_pad ($cobro->numero, 4, '0', STR_PAD_LEFT) }}
                        <small>
                            Emitido el {{ date('d/m/Y', strtotime($cobro->fecha)) }}
                        </small>
                    </h1>
                    </td>
                    <td style="text-align: left;">
                        <div>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <table class="client-detail">
        @if($cobro->anulado)
        <h1 id="anulado">
            ANULADO
        </h1>
        @endif

        <tr>
            <th style="width:100px;">
                Cliente
            </th>
            <td>{{ $cobro->cliente->primer_nombre }}
                {{ $cobro->cliente->segundo_nombre }}
                {{ $cobro->cliente->primer_apellido }}
                {{ $cobro->cliente->segundo_apellido }}</td>
        </tr>
        <tr>
            <th>NIT</th>
            <td>{{ $cobro->cliente->nit !== null ? $cobro->cliente->nit:'C/F' }}</td>
        </tr>
        <tr>
            <th>Ubicación</th>
            <td>{{$cobro->cliente->ubicacion.' '.$cobro->cliente->ubicacion_cliente->ubicacion }}</td>
        </tr>
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th width="25%" class="text-left">Cantidad (lt)</th>
                <th class="text-left">Descripción</th>
                <th class="text-right" style="width:100px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cobro->detalle as $d)
            <tr>
                <td>{{$d->lectura + $d->agua_extra}}</td>
                <td>
                    {{$d->mes->mes.'/'.$d->anio->anio}}
                 </td>
                <td class="text-right">Q {{number_format($d->total_mes, 2)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><h3>TOTAL: Q {{number_format($cobro->total, 2)}}</h3></td>
            </tr>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    </body>
</html>