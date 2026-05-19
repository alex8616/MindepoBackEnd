<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>

        @page {
            margin: 9px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }

        /* =========================
           FILA
        ========================= */

        .fila {
            width: 100%;

            /* ESPACIO ENTRE FILAS */

            padding: 0;

            /* elimina espacio inline-block */
            font-size: 0;
            line-height: 0;
            white-space: nowrap;
        }

        /* =========================
           TARJETA
        ========================= */

        .tarjeta {
            position: relative;

            width: 10cm;
            height: 6cm;

            overflow: hidden;

            display: inline-block;
            vertical-align: top;

            /* SIN ESPACIO ENTRE ANVERSO Y REVERSO */
            margin: 0;
            padding: 0;

            border: 0.6px dashed black;

            /* para mantener medidas exactas */
            box-sizing: border-box;
        }

        /* =========================
           IMAGEN
        ========================= */

        .imagen {
            width: 100%;
            height: 100%;

            position: absolute;
            top: 0;
            left: 0;

            display: block;
        }

        /* =========================
           NUMERO ANVERSO
        ========================= */

        .numero-anverso {
            position: absolute;

            top: 1.2cm;
            left: 3.2cm;

            font-size: 28px;
            font-weight: bold;

            color: black;
            line-height: normal;
        }

        /* =========================
           NUMERO REVERSO
        ========================= */

        .numero-reverso {
            position: absolute;

            top: 0.5cm;
            left: 3.2cm;

            font-size: 28px;
            font-weight: bold;

            color: black;
            line-height: normal;
        }

    </style>
</head>
<body>

@foreach($tarjetas as $index => $tarjeta)

    <div class="fila"><div class="tarjeta">

            <img
                src="{{ public_path('tarjetas/anverso_mujeres.png') }}"
                class="imagen"
            >

            <div class="numero-anverso">
                {{ $tarjeta['numero'] }}
            </div>

        </div><div class="tarjeta">

            <img
                src="{{ public_path('tarjetas/reverso_mujeres.png') }}"
                class="imagen"
            >

            <div class="numero-reverso">
                {{ $tarjeta['numero'] }}
            </div>

        </div></div>

    @if(($index + 1) % 4 == 0)
        <div class="page-break"></div>
    @endif

@endforeach

</body>
</html>