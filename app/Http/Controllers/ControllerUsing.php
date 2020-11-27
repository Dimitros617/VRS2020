<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class ControllerUsing extends Controller
{
    public function main()
    {
        $jmenoDatabaze = 'Jméno přihlášeného, které se bude brát z databáze, snad již brzy';
        $vypujcky_pocet_d = 'Zatím 0';
        $schvaleni_pocet_d = 'Zatím 0';

        echo "<script>console.log('Debug Objects: asdasdasdasdasdasdasdasd' );</script>";
        return view( 'main')->with(['fullname' => $jmenoDatabaze,
            'vypujcky_pocet' => $vypujcky_pocet_d, 'schvaleni_pocet' => $schvaleni_pocet_d]);

    }


}

//classa s metodami na zobrazování stran přes controllery
