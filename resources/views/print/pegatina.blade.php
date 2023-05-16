<html>
<head>
    <style>
        body{
            font-family: sans-serif;
            font-size:13px;
        }
        @page {
            margin: 30px 0px 0px 0px;
            height: 38mm;
            width:90mm;
        }

        header {
            position: fixed;
            left: 0px;
            top: -60px;
            right: 0px;
            height: 0px;
            text-align: center;
        }
        header h1{
            margin: 30px 0;
        }
        header h2{
            margin: 0 0 10px 0;
        }
        td{
            width: 50%;
        }
    </style>
<body>
<header>
    <table>
        <tr>
            <td>
                <h1>HIFORCEM</h1>
            </td>
        </tr>
    </table>
</header>

<div id="content">
    <table width="100%" height="100%" >
        <tr >
            <td>Forjado:  {{ $items["forjado"] }} </td>
            <td>Cliente:  {{ $items["cliente"] }}</td>
        </tr>
        <tr >
            <td>Tipo:  {{ $items["tipo"] }}</td>
            <td>Obra:  {{ $items["obra"] }}</td>
        </tr>
        <tr >
            <td>Medida:  {{ $items["medida"] }}</td>
            <td> </td>
        </tr>
        <tr >
            <td>Unidades:  {{ $items["unidades"] }}</td>
            <td>Planta:  {{ $items["planta"] }}</td>
        </tr>

    </table>

</div>
</body>
</html>

</body>
</html>