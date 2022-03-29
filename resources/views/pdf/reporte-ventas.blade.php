<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reporte de Ventas Farmacia La Bendición</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/custom_pdf.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/custom_page.css') }}">
    </head>
    <body>
        <section class="header" style="top: -287px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="3" class="text-center">
                        <span style="font-size: 25px; font-weight: bold;">Farmacia La Bendición</span>
                    </td>
                </tr>
                <br>
                <tr>
                    <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative;">
                        <img src="{{ asset('assets/img/logoS.jpg') }}" class="invoice-logo" alt="logo">
                    </td>
                    <td width="40%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                        <br>
                        @if($dateFrom != null && $dateTo != null)
                        <span style="font-size: 12px"><strong>Fecha de Consulta: {{$dateFrom}} al
                        {{$dateTo}}</strong></span>
                        @else
                        <span style="font-size: 12px"><strong>Fecha de Consulta:
                        {{ \Carbon\Carbon::now('America/El_Salvador')->format('d-M-Y')}}</strong></span>
                        @endif
                        <br>
                        <span style="font-size:11px">Usuario: {{$user}}</span>
                    </td>
                    @if (auth()->user()->profile == 'Administrador')
                    <td width="30%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                        <br>
                        <span style="font-size: 12px"><strong>Total:   &nbsp;  &nbsp; &nbsp;${{number_format($data->sum('total'),4)}}</strong></span><br>
                        <span style="font-size: 12px"><strong>Neto:    &nbsp;  &nbsp;  &nbsp; ${{number_format($data->sum('total') / 1.13,4)}}</strong></span><br>
                        <span style="font-size: 12px; color: red;"><strong>Costos:  &nbsp; ${{number_format($sumCostoGlobal,4)}} ( - )</strong></span><hr>
                        <span style="font-size: 12px; color: green;"><strong>Utilidad:  &nbsp; ${{number_format(($data->sum('total') / 1.13) - $sumCostoGlobal,4)}}</strong></span>
                        <br>
                    </td>
                    @endif
                </tr>
            </table>
        </section>
        <br>
        <section style="margin-top: -110px;">
            <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Transacción</th>
                        <th>N° Productos</th>
                        <th>Total</th>
                        <th>Recibido</th>
                        <th>Cambio</th>
                        <th>N° Factura</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $venta)
                    <tr">
                        <td class="text-center">
                            <p>{{$venta->folio}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$venta->tipo_transaccion}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$venta->items}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($venta->total,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($venta->cash,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>${{number_format($venta->change,4)}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$venta->numero_factura}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{$venta->usuario}}</p>
                        </td>
                        <td class="text-center">
                            <p>{{\Carbon\Carbon::parse($venta->created_at)->format('M d, Y h:i A')}}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" class="text-center">
                        <span><b>Total</b></span>
                    </td>
                    <td class="text-center">
                        {{$data->sum('items')}}
                    </td>
                    <td class="text-center">
                        <span><strong>${{number_format($data->sum('total'),4)}}</strong></span>
                    </td>
                    <td colspan="5"></td>
                </tr>
                </tfoot>
            </table>
        </section>
        <section class="footer">
            <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
                <tr>
                    <td width="20%">
                        <img src="{{ asset('assets/img/mangonegro.jpg') }}" class="invoice-logo" alt="logo2" width="20px" height="20px">
                    </td>
                    <td width="60%" class="text-center">
                        <span>Farmacia La Bendición</span>
                    </td>
                    <td width="20%" class="text-center">
                        pagina <span class="pagenum"></span>
                    </td>
                </tr>
            </table>
        </section>
    </body>
</html>