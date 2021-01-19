<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
//use Carbon\Carbon;
//use DateTime;
//use DB;
//use Illuminate\Support\Facades\Input;

//use App\Medicion;
//use Jenssegers\Date\Date;

class MapaController extends Controller
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

     //LISTADO PARA EL SELECT EN HTML
    public function showMeses()
    {
        
        $meses =  array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        
        return json_encode(array('data'=>$meses));
        
    }


     //LISTADO PARA EL SELECT EN HTML
    public function showAnyos()
    {
        
        $anyos =  array(
        	2009 =>  '2009',
        	2010 =>  '2010',
        	2011 =>  '2011',
        	2012 =>  '2012',
        	2013 =>  '2013',
        	2014 =>  '2014',
        	2015 =>  '2015',
        	2016 =>  '2016',
        	2017 =>  '2017',
        	2018 =>  '2018',
        	2020 =>  '2020');
        
        return json_encode(array('data'=>$anyos));
        
    }

    public function showMes(Request $request)
    {
    	//dd();
    	$imageURL = "";
    	switch ($request->mes) {
    		case '1':
    			$imageURL =  "img/mensual/M1_ENERO.png";
    			break;
			case '2':
    			$imageURL =  "img/mensual/M2_FEBRERO.png";
    			break;
    		case '3':
    			$imageURL =  "img/mensual/M3_MARZO.png";
    			break;
    		case '4':
    			$imageURL =  "img/mensual/M4_ABRIL.png";
    			break;
    		case '5':
    			$imageURL =  "img/mensual/M5_MAYO.png";
    			break;
			case '6':
    			$imageURL =  "img/mensual/M6_JUNIO.png";
    			break;
    		case '7':
    			$imageURL =  "img/mensual/M7_JULIO.png";
    			break;
    		case '8':
    			$imageURL =  "img/mensual/M8_AGOSTO.png";
    			break;
    		case '9':
    			$imageURL =  "img/mensual/M9_SEPTIEMBRE.png";
    			break;
			case '10':
    			$imageURL =  "img/mensual/M10_OCTUBRE.png";
    			break;
    		case '11':
    			$imageURL =  "img/mensual/M11_NOVIEMBRE.png";
    			break;
    		case '12':
    			$imageURL =  "img/mensual/M12_DICIEMBRE.png";
    			break;    			
    		
    		default:
    			# code...
    			break;     		
    	}
    	return json_encode(array('url'=>$imageURL));
    }

    public function showAnyo(Request $request)
    {
    	$imageURL = "";
    	switch ($request->anyo) {
    		case '2009':
    			$imageURL =  "img/anual/M14_2009.png";
    			break;
			case '2010':
    			$imageURL =  "img/anual/M15_2010.png";
    			break;
    		case '2011':
    			$imageURL =  "img/anual/M16_2011.png";
    			break;
    		case '2012':
    			$imageURL =  "img/anual/M17_2012.png";
    			break;
    		case '2013':
    			$imageURL =  "img/anual/M18_2013.png";
    			break;
			case '2014':
    			$imageURL =  "img/anual/M19_2014.png";
    			break;
    		case '2015':
    			$imageURL =  "img/anual/M20_2015.png";
    			break;
    		case '2016':
    			$imageURL =  "img/anual/M21_2016.png";
    			break;
    		case '2017':
    			$imageURL =  "img/anual/M22_2017.png";
    			break;
			case '2018':
    			$imageURL =  "img/anual/M23_2018.png";
    			break;
    		case '2020':
    			$imageURL =  "img/anual/M13_PROMEDIO_ANUAL.png";
    			break;
    		
    		default:
    			# code...
    			break;     		
    	}
    	return json_encode(array('url'=>$imageURL));
    }

}
