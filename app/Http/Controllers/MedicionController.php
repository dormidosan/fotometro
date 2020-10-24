<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DB;

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


    public function showRealTime()
    {
        /*
        $nuevaMedicion = new Medicion();
        $nuevaMedicion->fecha = Date::now()->format('Y-m-d');
        $nuevaMedicion->hora = Date::now()->format('H:i:s');
        $nuevaMedicion->medicion = rand(10, 70);
        */
        //$nuevaMedicion->save();


        //$totalData = Medicion::orderBy('id', 'DESC')->take(70)->pluck('medicion'); 
        $totalData = Medicion::select('fecha','hora','medicion')
        ->where('fecha', '=', '20200930')
        //->where('hora', '<', '15:45')
        ->orderBy('id', 'ASC')
        ->take(49)
        ->get(); 
        

        //dd(count($totalData));
        $newRows = 49 - count($totalData) ;
        //dd($newRows);
        //$lastHour = end($totalData)->hora;
        //$collection->last()['active'] 
        $nuevaHora = Carbon::createFromTimeString($totalData->last()['hora']);  

        //dd($nuevaHora->format('H:i'));
        //$dt->addMinutes(61);  

        while ($newRows > 0) {
            //echo 'entro';
            $nuevaHora = $nuevaHora->addMinutes(15); 
            $nuevaMedicion = new Medicion();
            $nuevaMedicion->fecha = $totalData[0]->fecha;
            $nuevaMedicion->hora = $nuevaHora->format('H:i');
            $nuevaMedicion->medicion = 0;

            //$totalData[] = ['fecha' => , 'hora' => '', 'medicion' => 0]; 
            //$totalData = $nuevaMedicion;

            $totalData->push($nuevaMedicion);

            $newRows--;
        }
        //dd($totalData);
       
        //return $totalData;
        return json_encode(array('data'=>$totalData));
        
    }

    public function showDaily(Request $request)
    {
        /*
        $nuevaMedicion = new Medicion();
        $nuevaMedicion->fecha = Date::now()->format('Y-m-d');
        $nuevaMedicion->hora = Date::now()->format('H:i:s');
        $nuevaMedicion->medicion = rand(10, 70);
        */
        //$nuevaMedicion->save();
        //$dt = DateTime::createFromFormat("H:i", $data->hora);
        //$hours = $dt->format('H'); // '20'
        $fechaBusqueda = '';
        //dd('1');
        //$totalData = Medicion::orderBy('id', 'DESC')->take(70)->pluck('medicion'); 
        if (strcmp($request->fecha, 'last')  == 0) {
            //dd('2');
            $fechaBusqueda = Medicion::orderBy('id', 'DESC')
            ->first()
            ->fecha;    
            //dd($fechaBusqueda);
        } else {
            //dd('3');
            $fechaBusqueda = $request->fecha;
        }
        
        //dd('4');
        
        //printf($fechaBusqueda);
        $totalData = Medicion::select('fecha','hora','medicion')
        ->where('fecha', '=', $fechaBusqueda)
        ->orderBy('id', 'ASC')
        ->get(); 

        //dd($totalData);
        if ($totalData->isEmpty()) {
            return json_encode(array('exito'=>'0','fecha'=>'','data'=>[]));
        }
        
        //dd($totalData);
        //dd($totalData);
        //dd($totalData);
        $firstHour = Carbon::createFromTimeString($totalData[0]->hora)->hour; //$totalData[0]->hora;
        $arrayRetorno  = array();
        //dd($firstHour);
        $contador = 0;
        $promedio  = 0 ;
        foreach ($totalData as $data) {

            //$dt = DateTime::createFromFormat("H:i", $data->hora);
            //$hours = $dt->format('H'); // '20'
            $dt = Carbon::createFromTimeString($data->hora);

            if ($firstHour == $dt->hour) {
//--                echo "\nAplica " . $dt . " " . $data->medicion ;
                $promedio = $promedio + $data->medicion;
                $arrayRetorno[$contador] = ['hora' => $firstHour, 'promedio' => $promedio]; 
            } else {
//--                echo "\nNO aplica " . $dt . " " . $data->medicion ;
            }
            
        }


        $arrayHoras = array();
        //$arrayHoras[] = ['hora' => $firstHour];

        //EXTRAER LAS HORAS VALIDAS
        foreach ($totalData as $data) {
            $hora = Carbon::createFromTimeString($data->hora)->hour;  
            //$lastArrayHoras = end($arrayHoras);
            if (in_array($hora, $arrayHoras)) {
//--                echo "\n Ya existe " . $hora;
            } else {
//--                echo "\n Ingresando " . $hora;
                $arrayHoras[] = $hora;
            }
                            
            
        }
       
       $arrayHorasPromedio = array();
       foreach ($arrayHoras as $rowHora) {
//--           echo "\n ArrayHora " .$rowHora ;

           $contador = 0;
           $promedio  = 0 ;
           foreach ($totalData as $data) {
               $nuevaHora = Carbon::createFromTimeString($data->hora)->hour;  
               if ($rowHora == $nuevaHora && $data->medicion > 0) {
               //if ($rowHora == $nuevaHora ) {
                    $promedio = $promedio + $data->medicion;
                    $contador++;
                } else {
                    //echo " _. " . $nuevaHora;
                }           

            }
//--            echo "\n Promedio 1 " . $promedio;
            if ($contador > 0 ) {
                $promedio = $promedio / $contador;
            }
//--            echo "\n Promedio 2 " . $promedio;
            $arrayHorasPromedio[] = ['hora' => $rowHora,'promedio' => $promedio];

       }

       //Carbon::setLocale('es');
       $fechaBusqueda = Carbon::createFromFormat('Y-m-d', $fechaBusqueda)->locale('es')->isoFormat('dddd D [de] MMMM');
       //Carbon::createFromFormat('Y-m-d', $mesBusqueda)
        //return $totalData;
        return json_encode(array('exito'=>'1','fecha'=>$fechaBusqueda,'data'=>$arrayHorasPromedio));
        
    }

    public function showMonthly(Request $request)
    {
        /*
        $nuevaMedicion = new Medicion();
        $nuevaMedicion->fecha = Date::now()->format('Y-m-d');
        $nuevaMedicion->hora = Date::now()->format('H:i:s');
        $nuevaMedicion->medicion = rand(10, 70);
        */
        //$nuevaMedicion->save();


        //$totalData = Medicion::orderBy('id', 'DESC')->take(70)->pluck('medicion'); 
        $mesBusqueda = '';
        //dd('1');
        //$totalData = Medicion::orderBy('id', 'DESC')->take(70)->pluck('medicion'); 
        if (strcmp($request->mes, 'last')  == 0) {
            //dd('2');
            $mesBusqueda = Medicion::orderBy('id', 'DESC')
            ->first()
            ->fecha; 
            $mesBusqueda = Carbon::createFromFormat('Y-m-d', $mesBusqueda)->month ;     
            if ($mesBusqueda == Carbon::now()->month) {
                $mesBusqueda =  $mesBusqueda - 1;
            }
            
            //dd($fechaBusqueda);
        } else {
            //dd('3');
            $mesBusqueda = $request->mes;
        }


        
        $totalData = Medicion::select(DB::raw("DAY(fecha) AS fecha"),'medicion')
        ->whereMonth('fecha', '=', $mesBusqueda)
        ->orderBy('id', 'ASC')
        ->get(); 
        //dd($totalData);
        //  $arrayDiasPromedio = array();
        //  $arrayDiasPromedio[] = ['dia' => '1','promedio' => rand(100, 1000)];
        //  $arrayDiasPromedio[] = ['dia' => '2','promedio' => rand(100, 1000)];
        //  return json_encode(array('data'=>$arrayDiasPromedio));

        $arrayDias = array();

        //EXTRAER LOS DIAS VALIDAS
        foreach ($totalData as $data) {
            //$dia = Carbon::createFromFormat('Y-m-d', $data->fecha)->day;  
            //$dia = DateTime::createFromFormat( 'Y-m-d', $data->fecha)->format('d');
            //$dia = $data->fecha;
            //echo $oDateTime1->format('Y-m-d')



            //$lastArrayHoras = end($arrayHoras);
            if (in_array($data->fecha, $arrayDias)) {
//--                echo "\n Ya existe " . $hora;
            } else {
//--                echo "\n Ingresando " . $hora;
                $arrayDias[] = $data->fecha;
            }
                            
            
        }
        //dd($arrayDias);

        $arrayDiasPromedio = array();
       foreach ($arrayDias as $rowDia) {
//--           echo "\n ArrayHora " .$rowHora ;

           $contador = 0;
           $promedio  = 0 ;
           foreach ($totalData as $data) {
               //$nuevoDia = Carbon::createFromFormat('Y-m-d', $data->fecha)->day;  
               //$nuevoDia = DateTime::createFromFormat( 'Y-m-d', $data->fecha)->format('d');
               $nuevoDia = $data->fecha;
               if ($rowDia == $nuevoDia && $data->medicion > 0) {
               //if ($rowHora == $nuevaHora ) {
                    $promedio = $promedio + $data->medicion;
                    $contador++;
                } else {
                    //echo " _. " . $nuevaHora;
                }           

            }
//--            echo "\n Promedio 1 " . $promedio;
            if ($contador > 0 ) {
                $promedio = $promedio / $contador;
            }
//--            echo "\n Promedio 2 " . $promedio;
            $arrayDiasPromedio[] = ['dia' => $rowDia,'promedio' => $promedio];

       }
        //dd($arrayDiasPromedio);       
        //return $totalData;
        return json_encode(array('mes'=> $this->listadoMeses($mesBusqueda),'data'=>$arrayDiasPromedio));
        
    }


    public function showMeses()
    {
        
        $meses =  array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre');
        
        return json_encode(array('data'=>$meses));
        
    }

    public function listadoMeses($mes)
    {
        
        $meses =  array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre');
        
        return $meses[$mes];
        
    }


}
