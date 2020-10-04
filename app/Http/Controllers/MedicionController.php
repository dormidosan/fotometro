<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Medicion;
use Jenssegers\Date\Date;

class MedicionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mediciones.index');
    }


    public function show()
    {
        $nuevaMedicion = new Medicion();
        $nuevaMedicion->fecha = Date::now()->format('Y-m-d');
        $nuevaMedicion->hora = Date::now()->format('H:i:s');
        $nuevaMedicion->medicion = rand(10, 70);
        $nuevaMedicion->save();


        $totalData = Medicion::orderBy('id', 'DESC')->take(100)->pluck('medicion'); 
        //dd($totalData);
        
       
        return json_encode($totalData);
        
    }
}
