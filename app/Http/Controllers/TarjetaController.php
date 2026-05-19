<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class TarjetaController extends Controller
{
    public function GenerarVarones()
    {
        $tarjetas = [];

        for ($i = 501 ; $i <= 1000; $i++) {

            $numero = 'P.V. - ' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $tarjetas[] = [
                'numero' => $numero,
                'anverso' => asset('tarjetas/anverso_varones.png'),
                'reverso' => asset('tarjetas/reverso_varones.png'),
            ];
        }

        $pdf = Pdf::loadView('pdf.tarjetas_varones', compact('tarjetas'));

        //$pdf->setPaper('legal');

        $pdf->setPaper('legal');

        return $pdf->stream('tarjetas_varones.pdf');
    }

    public function GenerarMujeres()
    {
        $tarjetas = [];

        for ($i = 1; $i <= 200; $i++) {

            $numero = 'P.M. - ' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $tarjetas[] = [
                'numero' => $numero,
                'anverso' => asset('tarjetas/anverso_mujeres.png'),
                'reverso' => asset('tarjetas/reverso_mujeres.png'),
            ];
        }

        $pdf = Pdf::loadView('pdf.tarjetas_mujeres', compact('tarjetas'));

        $pdf->setPaper('legal');

        return $pdf->stream('tarjetas_mujeres.pdf');
    }

    public function GenerarAislamientoF()
    {
        $tarjetas = [];

        for ($i = 1; $i <= 200; $i++) {

            $numero = '     ' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $tarjetas[] = [
                'numero' => $numero,
                'anverso' => asset('tarjetas/anverso_aislamientoF.png'),
                'reverso' => asset('tarjetas/reverso_aislamientoF.png'),
            ];
        }

        $pdf = Pdf::loadView('pdf.tarjetas_aislamientoF', compact('tarjetas'));

        $pdf->setPaper('legal');

        return $pdf->stream('tarjetas_aislamientoF.pdf');
    }

    public function GenerarAislamientoC()
    {
        $tarjetas = [];

        for ($i = 1; $i <= 200; $i++) {

            $numero = 'A.C. - ' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $tarjetas[] = [
                'numero' => $numero,
                'anverso' => asset('tarjetas/anverso_aislamientoC.png'),
                'reverso' => asset('tarjetas/reverso_aislamientoC.png'),
            ];
        }

        $pdf = Pdf::loadView('pdf.tarjetas_aislamientoC', compact('tarjetas'));

        $pdf->setPaper('legal');

        return $pdf->stream('tarjetas_aislamientoC.pdf');
    }

    public function GenerarAbogado()
    {
        $tarjetas = [];

        for ($i = 1; $i <= 200; $i++) {

            $numero = 'A.C. - ' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $tarjetas[] = [
                'numero' => $numero,
                'anverso' => asset('tarjetas/anverso_abogado.png'),
                'reverso' => asset('tarjetas/reverso_abogado.png'),
            ];
        }

        $pdf = Pdf::loadView('pdf.tarjetas_abogados', compact('tarjetas'));

        $pdf->setPaper('legal');

        return $pdf->stream('tarjetas_abogados.pdf');
    }
}