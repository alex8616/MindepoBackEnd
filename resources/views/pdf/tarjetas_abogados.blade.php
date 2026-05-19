<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>

        @page {
            margin: 5px;
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
            margin: 0;
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

            /* SIN ESPACIO */
            margin: 0;
            padding: 0;

            /* BORDE NEGRO */
            border: 1px dashed #BFC6C4;

            /* mantener tamaño exacto */
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

    top: 0.45cm;
    left: 5.9cm;

    font-size: 20px;
    font-weight: bold;

    color: black;
    line-height: normal;

    text-decoration: underline;
}

/* =========================
   NUMERO REVERSO
========================= */

.numero-reverso {
    position: absolute;

    top: 0.45cm;
    left: 3.7cm;

    font-size: 20px;
    font-weight: bold;

    color: black;
    line-height: normal;

    text-decoration: underline;
}

    </style>
</head>
<body>

@foreach($tarjetas as $index => $tarjeta)

    @php
        $numero = str_pad($index + 1, 6, '0', STR_PAD_LEFT);
    @endphp

    <div class="fila"><div class="tarjeta">

            <img
                src="{{ public_path('tarjetas/anverso_abogado.png') }}"
                class="imagen"
            >

            <div class="numero-anverso">
                Nº {{ $numero }}
            </div>

        </div><div class="tarjeta">

            <img
                src="{{ public_path('tarjetas/reverso_abogado.png') }}"
                class="imagen"
            >

            <div class="numero-reverso">
                Nº {{ $numero }}
            </div>

        </div></div>

    @if(($index + 1) % 4 == 0)
        <div class="page-break"></div>
    @endif

@endforeach

</body>
</html>