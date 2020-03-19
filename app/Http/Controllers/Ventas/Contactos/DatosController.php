<?php

namespace App\Http\Controllers\Ventas\Contactos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ventas\Contactos\Ruc;
use App\Models\Ventas\Contactos\Agua;
use App\Models\Ventas\Contactos\Datos;
use App\Models\Ventas\Contactos\Deudor;
use App\Models\Ventas\ClientesVentas;
use App\Models\Predictivo\Logpredictivo;
use App\Models\Ventas\Contactos\Medidor;
use App\Models\Ventas\Contactos\Trabajo;
use App\Models\Ventas\Contactos\Telefonos;
use App\Models\Ventas\DAMPLUSagendadetalle;
use DB;
use Carbon\Carbon;
class DatosController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('Ventas.Contactos.index');
    }

    
    public function show($id,$ced)
    {

        $date = Carbon::now();
        $fechaacregisto= $date->format('d-m-Y H:i');
       
        /**
         * buscar datos del cliente en tbcampañaPersona
         */
        $datos          = ClientesVentas::where('cedula',$ced)->where('campana',$id)->first();
       
        /**
         * busco los datos relacionados al cliente en la tabla TBL_CLIENTE_VTA
         */
        $datosgenerales = Datos::where('cedula',$ced)->first();
        /**
         * busco los datos relacionados al cliente en la tablA TBL_RUC_VTA
         */
        $ruc            = Ruc::where('CEDULA',$ced)->first();
        /**
         * busco los datos relacionados al cliente en la tabla TBL_TELEFONOS_VTA
         */
        $telefonos      = Telefonos::where('CEDULA',$ced)->get();
        /**
         * busco los datos relacionados al cliente en la tabla TBL_TRABAJO_VTA
         */
        $trabajo        = Trabajo::where('CEDULA',$ced)->first();

         /**
         * busco los datos relacionados al cliente en la tabla TBL_MEDIDOR
         */
        $medidor        = Medidor::where('CEDULA',$ced)->first();
    
        /**
         * busco los datos relacionados al cliente en la tabla TBL_MEDIDOR
         */
        $agua        = Agua::where('CEDULA',$ced)->first();

        /**
         * listar los contactos de predictivo
         */
        $Logpredictivo        = Logpredictivo::where('cedula',$ced)->get();
       
        /**
         * busco la cedulas de los parentescos en TBL_PARENTESCO_VTA
         */
        $cedula_parientes   = Deudor::select('CED_PARIENETE')->where('CED_DEUDOR',$ced)->DISTINCT('CED_PARIENETE')->take(200)->get();

        $cedulas_parentescos[]="";
        foreach ($cedula_parientes as  $parentesco) {
        $cedulas_parentescos[] =$parentesco->CED_PARIENETE;
        }


        
  

/**
 * Buscar Datos de Parenntescos 
 */
        $telefonosparentescos = Datos::select(
                                                'TBL_TELEFONOS_VTA.TLF_FIJO1',
                                                'TBL_TELEFONOS_VTA.TLF_FIJO2',	
                                                'TBL_TELEFONOS_VTA.TLF_FIJO3',	
                                                'TBL_TELEFONOS_VTA.TLF_FIJO4',
                                                'TBL_TELEFONOS_VTA.CEL1_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL2_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL3_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL4_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL5_NVO1',
                                                'TBL_TELEFONOS_VTA.CEL6_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL7_NVO1',	
                                                'TBL_TELEFONOS_VTA.CEL8_NVO1',
                                                
                                                'TBL_CLIENTE_VTA.cedula',	
                                                'TBL_CLIENTE_VTA.NOMBRES',	
                                                'TBL_CLIENTE_VTA.DES_CIUDADANIA',	
                                                'TBL_CLIENTE_VTA.FECH_NAC',	
                                                'TBL_CLIENTE_VTA.edad',	
                                                'TBL_CLIENTE_VTA.DES_NACIONALID',	
                                                'TBL_CLIENTE_VTA.DES_ESTADO_CIVIL',	
                                                'TBL_CLIENTE_VTA.DES_PROFESION',	
                                                'TBL_CLIENTE_VTA.prov',	
                                                'TBL_CLIENTE_VTA.ciudad',	
                                                'TBL_CLIENTE_VTA.direc_cedula',

                                                'TBL_PARENTESCO_VTA.CED_DEUDOR',	
                                                'TBL_PARENTESCO_VTA.CED_PARIENETE',	
                                                'TBL_PARENTESCO_VTA.DESC_PARIENTE'
                                            )
                                        ->join('TBL_PARENTESCO_VTA', 'TBL_PARENTESCO_VTA.CED_PARIENETE', '=', 'TBL_CLIENTE_VTA.cedula')
                                        ->join('TBL_TELEFONOS_VTA', 'TBL_TELEFONOS_VTA.CEDULA', '=', 'TBL_PARENTESCO_VTA.CED_PARIENETE')
                                        ->whereIn('TBL_TELEFONOS_VTA.CEDULA',$cedulas_parentescos)
                                        ->where('TBL_PARENTESCO_VTA.CED_DEUDOR',$ced)
                                        ->orderBy('TBL_PARENTESCO_VTA.DESC_PARIENTE')
                                        ->get();
         
                                        $trabajoparientes = Datos::select(
                                            'TBL_TRABAJO_VTA.*',
                                            'TBL_PARENTESCO_VTA.*',
                                            'TBL_CLIENTE_VTA.*'
                                            )
                                                ->join('TBL_PARENTESCO_VTA', 'TBL_PARENTESCO_VTA.CED_PARIENETE', '=', 'TBL_CLIENTE_VTA.cedula')
                                                ->join('TBL_TRABAJO_VTA', 'TBL_TRABAJO_VTA.CEDULA', '=', 'TBL_PARENTESCO_VTA.CED_PARIENETE')
                                                ->whereIn('TBL_TRABAJO_VTA.CEDULA',$cedulas_parentescos)
                                                ->where('TBL_PARENTESCO_VTA.CED_DEUDOR',$ced)
                                                ->orderBy('TBL_PARENTESCO_VTA.DESC_PARIENTE', 'DESC')
                                                ->get();

                                                $RUCparientes = Datos::select(
                                                    'TBL_RUC_VTA.*',
                                                    'TBL_PARENTESCO_VTA.*',
                                                    'TBL_CLIENTE_VTA.*'
                                                    )
                                                        ->join('TBL_PARENTESCO_VTA', 'TBL_PARENTESCO_VTA.CED_PARIENETE', '=', 'TBL_CLIENTE_VTA.cedula')
                                                        ->join('TBL_RUC_VTA', 'TBL_RUC_VTA.CEDULA', '=', 'TBL_PARENTESCO_VTA.CED_PARIENETE')
                                                        ->whereIn('TBL_RUC_VTA.CEDULA',$cedulas_parentescos)
                                                        ->where('TBL_PARENTESCO_VTA.CED_DEUDOR',$ced)
                                                        ->orderBy('TBL_PARENTESCO_VTA.DESC_PARIENTE', 'DESC')
                                                        ->get();
      


        

//dd($trabajoparientes);



$agenda = DB::connection('sqlsrv4')->select("SELECT *,DATEDIFF(day,getdate(), fecha) as dias,CONVERT(VARCHAR, hora, 108) horas from DAMPLUSagenda where cedula ='$ced' and campana='$id'");

$idcc = $id.$ced;
$idc = $id;


$tocado           = DAMPLUSagendadetalle::where('idc',$idcc)->update(['tocado'  => 1]);
//dd($fechaacregisto);
$tocadodate           = DAMPLUSagendadetalle::where('idc',$idcc)->update(['tocadodate'  => $fechaacregisto]);
        return view('Ventas.Contactos.show',compact('idc','ced','idcc','datos','datosgenerales','ruc','telefonos','telefonosparentescos','medidor','trabajo','agua','trabajoparientes','RUCparientes','Logpredictivo','agenda'));
    }

   
}
