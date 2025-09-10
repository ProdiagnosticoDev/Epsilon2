@php
  
    $titulo = $tipo_carta == 1 ? "Carta prórroga_{$name}" : "Carta no prórroga_{$name}";
    $asunto = $tipo_carta == 1 ? "Prórroga de contrato a término fijo" : "No prórroga de contrato a término fijo";
    $descripcion = $tipo_carta == 1 ? "Se prorrogará hasta el próximo $fecha_fin" : "No se prorrogará y terminará en $fecha_fin";

@endphp

<!DOCTYPE html>
<html>
<head>
    <title>{{ $titulo }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

<style>
    .table, .table th, .table td {
        border: 1px solid black;
        border-collapse: collapse;
        width:100%;
    }
    .table th, .table td {
        padding: 6px;
        text-align: left;
        height:60px;
    }
</style>    
</head>
<body>

    <img src="{{ public_path('assets/img/prodx-logo.jpg') }}" alt="logo empresarial" style="width:250px;">

    <p>Medellín, {{ $date }}</p>

    <p>Estimado(a): {{ $name }}</p> 

    <p>La empresa <b>Prodiagnóstico S.A.,</b> con NIT <b>800.250.192</b>, por este medio le informa al (a la) señor(a) {{ $name }},
    identificado(a) con {{$TipoDocumento}} N° {{$documento}}, cargo {{ $cargo }}.</p>

    <p>Su contrato firmado el pasado {{ $fecha_ingreso }}. {{$descripcion}}.</p>

    @if ($tipo_carta == 1)

        <p>De conformidad a lo acordado entre las partes.</p> 

        <p>Lo anterior se realiza de acuerdo a lo señalado en el artículo 46 del Código Sustantivo De Trabajo, subrogado por el artículo 3 de la Ley 50 de 1990, el cual señala que el contrato a término fijo, únicamente podrá prorrogarse sucesivamente hasta por 3 periodos iguales o inferiores (…)</p> 

    @else

        <p>La presente notificación de no prórroga de contrato de trabajo se realiza con más de treinta (30) días de anticipación, en atención a lo establecido la legislación laboral vigente.</p>  

        <p>Le expresamos nuestros más sinceros agradecimientos por su colaboración y compromiso con nuestra organización.</p> 

    @endif
    
    <br>

    <p>Atentamente</p>

    <br>

    <img src="{{ public_path('assets/img/Firma-TH.JPG') }}" alt="logo empresarial" style="width:250px;">

    <br>

    <p><b>NOMBRE DEL COORDINADOR</b></p>
    <p>Coordinador(a) de Talento Humano</p>

    <p>Elaborado por:  {{$currentuser}}</p>
    <p>Identificado(a) con N°:{{$currentuser_id}}</p>        

    <br>
    <br>
    <br>

    <table border="0" class="table"  cellpadding="6">
        <tr>
            <th>Firma de recibido</th>
            <th>N° de identificación</th>
            <th>Fecha de recibido: (dd/mm/aaaa)</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>





</body>
</html>
