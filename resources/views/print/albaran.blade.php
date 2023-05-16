<html>
<head>
    <style>
        body{
            font-family: sans-serif;
            font-size:12px;
        }
        @page {
            margin-top: 160px;
            margin-left:  50px;
            margin-right: 50px;
            margin-bottom: 160px;
        }
        header { position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 300px;
            text-align: center;
            margin-bottom: 40px;
        }
        header h1{
            margin: 10px 0;
        }
        header h2{
            margin: 0 0 10px 0;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            border-bottom: 2px solid #ddd;
        }
        footer .page:after {
            content: counter(page);
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
        }
    </style>
<body>
<header>
    <table width="100%">
        <tr>
            <td align="left">
             <!--<img src="{{asset('img/cartel2c.jpg')}}" width="250px">-->
            </td>
            <td align="center">
                <b>HIFORCEM</b> VIGAS Y <br>
                PREFABRICADOS. S.L. <br>
                CIF- B91946483 <br>
                C/ LA VEGA, 7 <br>
                11650 <b> VILLAMARTIN </b>(Cádiz) <br>
                <b>Tlfs.</b> 956 73 04 34 <br>
                <b>Movil</b> 674 91 26 48 <br>
                <b>Fax</b> 956 73 00 38 <br>
                Email: hiforcemvillamartin@gmail.com <br>
                hiforcem@hiforcem.es <br>
                WEB: www.hiforcem.es <br>
            </td>
        </tr>
    </table>

</header>
<footer>
    <table style="border: 1px solid black">
        <tr>
            <td> 
                <b>Metros Totales:</b>
            </td>
            <td>
                {{ $size }}
            </td>
            <td>
                <b>Peso:</b>
            </td>
            <td>
                {{ $weight }}
            </td>
            <td>
                <b>Neto:</b>
            </td>
            <td>
                {{ $bruto }}
            </td>
            <td>
                <b>Total (sin IVA):</b>
            </td>
            <td>
                {{ $order->total }}
            </td>
        </tr>
    </table>
    <table style="border: 1px solid black">
        <tr>
            <td><b>NETO</b></td>
            <td><b>APORTE EXTRA</b></td>
            <td><b>PORTES</b></td>
            <td><b>PALOS</b></td>
            <td><b>SUBTOTAL</b></td>
            <td><b>IVA</b></td>
            <td><b>TOTAL IVA</b></td>
            <td colspan="2" align="right"><b>TOTAL</b></td>
        </tr>
        <tr>
            <td>{{ $order->total }}</td>
            <td>{{ $order->ship_extra }}</td>
            <td>{{ $order->shipping_cost }}</td>
            <td>{{ number_format(($order->palos * 1.40),2) }}</td>
            <td>{{ number_format(($order->total + $order->shipping_cost + $order->palos * 1.40),2) }}</td>
            <td>21%</td>
            <td>{{ number_format(($order->total + $order->shipping_cost + $order->palos * 1.40) * 0.21,2)}}</td>
            <td colspan="2" align="right"><b>{{ number_format( ($order->ship_extra+ $order->total + $order->shipping_cost + $order->palos * 1.40) +  ($order->total + $order->shipping_cost + $order->palos * 1.40) * 0.21,2)}}</b></td>
        </tr>
    </table>
    <table style="border: 1px solid black">
        <tr>
            <td colspan="2"><b>Transportista</b></td>
            <td colspan="1"><b>Matricula</b></td>
            <td colspan="2"><b>Tipo</b></td>
            <td colspan="2"><b></b></td>
        </tr>
        <tr>
            <td colspan="2">{{ $order->transporter }}</td>
            <td colspan="1">{{ $order->matricula }}</td>
            <td colspan="2">{{ $order->remolque}}</td>
            <td colspan="2"></td>
        </tr>
    </table>
</footer>
<div id="content" style="margin-top: 10px; width: 100%;">
    <table width="100%">
        <tr>
            <td align="left">
                <table width="260px"  style="border: 1px solid black;">
                    <tr>
                        <td>
                            Factura
                        </td><td>
                            {{ $order->factura}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cliente
                        </td>
                        <td>
                            {{ $user->codigo}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Fecha
                        </td>
                        <td>
                            {{ $order->date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Albarán
                        </td>
                        <td>
                            {{ $order->albaran}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Obra
                        </td>
                        <td>
                            {{ $order->obra}}
                        </td>
                    </tr>
                    
                </table>
            </td>
            <td width="140px">
                
            </td>
            <td >
                <table  width="260px" style="border: 1px solid black;">
                    <tr>
                        <td>
                            {{ $user->razon}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $user->address}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $user->pc}} {{ $order->city}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $user->province}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $user->NIF}}
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        
    </table>
    <table width="100%">
        <tr >
            <td style="border-bottom: 1px black solid; "><b>Uds</b></td>
            <td style="border-bottom: 1px black solid" colspan="2"><b>Medida</b></td>
            <td style="border-bottom: 1px black solid"><b>Metros Tipo</b></td>
            <td style="border-bottom: 1px black solid"><b>Tipo</b></td>
            <td style="border-bottom: 1px black solid"><b>Precio M.</b></td>
            <td style="border-bottom: 1px black solid"><b>Imp. Bruto</b></td>
            <td style="border-bottom: 1px black solid"><b>Descuentos T</b></td>
            <td style="border-bottom: 1px black solid"><b>Descuento</b></td>
            <td style="border-bottom: 1px black solid"><b>Importe Neto</b></td>
        </tr>

        @foreach($items as $item)
            <tr>
                <td>{{ $item["qty"] }}</td>
                @if($item["category_id"] == 8 && $item["Punta"] == "Sí")
                    <td>{{ $item["size"] - 0.30 }}</td>
                    <td>{{ $item["size"] }}</td>
                @else
                    <td></td>
                    <td>{{ $item["size"] }}</td>

                @endif
                <td>{{ $item["size"] * $item["qty"]}}</td>
                <td>{{ $item["title"] }}</td>
                <td align="right">
                    @if($order->ship)
                        {{ number_format( $item["totalEnvio"] / ($item["size"] * $item["qty"]) ,2 )}}
                    @else
                        {{ number_format( $item["total"] / ($item["size"] * $item["qty"]), 2) }}
                    @endif
                </td>
                <td align="right">{{ $item["bruto"] }}</td>
                <td align="right">{{ $item["discount"] }}%</td>
                <td align="right">{{ number_format($item["bruto"] * ($item["discount"]/100),2) }}</td>
                <td align="right">{{ $item["total"] }}</td>
            </tr>
        @endforeach

        
    </table>



</div>
</body>
</html>