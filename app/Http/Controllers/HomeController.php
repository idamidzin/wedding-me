<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Greeting;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $to = $request->has('to') ? $request->to : null;

        $data = (object) [
            'day' => 'Sabtu',
            'date' => '2024-07-13',
            'time_range' => '08.00 - 14.00 WIB',
            'akad_location' => 'Gedung Sanggariang',
            'resepsi_location' => 'Gedung Sanggariang',

            'cpp_name' => 'Idam Idzin Dimiati',
            'cpp_child_number' => 'Putra Tunggal',
            'cpp_father' => 'Muslihudin Anawawi (Kyai. Udin)',
            'cpp_mother' => 'Ati Solihati',
            'cpp_address' => 'Blok Rumahlega, Dusun Manis, Rt10/Rw04 Desa Cipasung, Kec. Darma, Kab. Kuningan',

            'cpw_name' => 'Rika Febriyanti',
            'cpw_child_number' => 'Putri Kedua',
            'cpw_father' => 'H. Oyo Sutrisno (Alm)',
            'cpw_mother' => 'Hj. Mimin Mintarsih',
            'cpw_address' => 'Blok Rumahlega, Dusun Manis, Rt10/Rw04 Desa Cipasung, Kec. Darma, Kab. Kuningan',
        ];

        return view('home', compact('to'));
    }
}
