<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Asignacion;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Ventas\ClientesVentas;
use App\Models\Ventas\Damplusagenda;
use App\Models\Ventas\DAMPLUSagendadetalle;
use Illuminate\Console\Command;
use Auth;
use Excel;
use DB;
use Carbon\Carbon;


use App\Collection;
class BandejaventasController extends Controller
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
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
        //$clientes = ClientesVentas::where("fec",'like',$request->texto."%")->take(10)->get();

        $clientes = DB::connection('sqlsrv4')->table('tbCampañaPersona')
            ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
        
            ->select('tbCampañaPersona.IdCampañaPersona',
                      'tbCampañaPersona.Campo2',
                      'tbCampañaPersona.Campo8',
                      'tbCampaña.Descripcion',
                      'tbCampañaPersona.IdCampaña')
            
            
            ->whereIn('tbCampañaPersona.IdCampaña',['50','33']) 
            ->take(1)->get();
              /**total clientes agendados pendientes  */
            /*  $agendadosHOY = DB::connection('sqlsrv4')->select("SELECT  *,CONVERT(VARCHAR, hora, 108) horas ,DATEDIFF(day,getdate(), fecha) as dias
              from DAMPLUSagenda where 
              users='$usuario' 
              and fecha ='$fecha'
              and estado='A' order by fecha,hora   
              ");
              */

            /*$agendados = DB::connection('sqlsrv4')->select("SELECT  *,CONVERT(VARCHAR, hora, 108) horas ,DATEDIFF(day,getdate(), fecha) as dias
            from DAMPLUSagenda where 
            users='$usuario' 
            and fecha >'$fecha'
            and estado='A' order by fecha,hora   
            ");
*/
          /*  $agendadosvencidos = DB::connection('sqlsrv4')->select("SELECT  *,CONVERT(VARCHAR, hora, 108) horas ,DATEDIFF(day,getdate(), fecha) as dias
            from DAMPLUSagenda where 
            users='$usuario'
            and estado='V' 
            and NOT idc  in (select idc FROM DAMPLUSagenda where users='$usuario' and estado IN ('A','N')) order by fecha,hora   
            ");

*/   
    $estados = array('A','V','G');
            $agendadosHOY = DAMPLUSagendadetalle::where('users',$usuario)->where('estado','A')->where('fecha',$fecha)->whereNull('tocado')->orderBy('fecha')->get();
            $agendados = DAMPLUSagendadetalle::where('users',$usuario)->where('estado','A')->where('fecha','>',$fecha)->whereNull('tocado')->orderBy('fecha')->get();
            $agendadosvencidos = DAMPLUSagendadetalle::where('users',$usuario)->where('estado','V')->whereNull('tocado')->orderBy('fecha')->get();
            $tocados = DAMPLUSagendadetalle::where('users',$usuario)->where('tocado',1)->whereIn('estado',$estados)->orderBy('tocadodate')->get();
            $xgestion = DAMPLUSagendadetalle::where('users',$usuario)->where('estado','G')->whereNull('tocado')->get();
//DD($agendadosvencidos);
        return view('Ventas.Bandeja.index',compact('clientes','agendados','agendadosHOY','agendadosvencidos','tocados','xgestion'));


                      

        
    }

    public function show($idc,$ced)
    {
     
        //$datos = ClientesVentas::where('IdCampañaPersona',$ced)->where('IdCampaña',$idc)->first();
        $datos = DB::connection('sqlsrv4')->table('tbCampañaPersona')
            ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
            ->select('tbCampañaPersona.*',
                      'tbCampaña.Descripcion',
                      'tbCampañaPersona.IdCampaña')
                       ->where('tbCampañaPersona.IdCampañaPersona',$ced)
                      ->where('tbCampañaPersona.IdCampaña',$idc)
            ->first();
      
        $gestiones = DB::connection('sqlsrv4')->select("SELECT   
                                                            c.IdCampañaPersona as cedula,
                                                            c.Campo2 as nombres,
                                                            a.Contacto,
                                                            a.Observacion,
                                                            a.FecRegistro,
                                                            a.UsuRegistro,
                                                            a.FecEdicion,
                                                            a.UsuEdicion,
                                                            a.Venta,
                                                            b.Descripcion as estado, 
                                                            d.Descripcion,
                                                            max(a.FecRegistro) as fecha
                                                            from tbRegistroLlamada as a, tbValorDetalle as b,tbCampañaPersona as c, tbCampaña as d 
                                                            where 
                                                                c.IdCampañaPersona='$ced'
                                                            and  a.IdRespuesta=b.IdValorDetalle 
                                                            and a.IdCampaña=d.IdCampaña
                                                            and c.IdCampañaPersona=a.IdCampañaPersona
                                                            and a.IdCampaña='$idc' 
                                                            group by   c.IdCampañaPersona ,
                                                            c.Campo2 ,
                                                            a.Contacto,
                                                            a.Observacion,
                                                            a.FecRegistro,
                                                            a.UsuRegistro,
                                                            a.FecEdicion,
                                                            a.UsuEdicion,
                                                            a.Venta,
                                                            b.Descripcion, 
                                                            d.Descripcion
                                                            order by a.FecRegistro desc
                                                            ");


$agenda = DB::connection('sqlsrv4')->select("SELECT *,DATEDIFF(day,getdate(), fecha) as dias,CONVERT(VARCHAR, hora, 108) horas from DAMPLUSagenda where cedula ='$ced' and campana='$idc'");

        
          
        return view('Ventas.Clientes.show',compact('datos','gestiones','ced','idc','agenda'));

                      

        
    }

    public function buscador(Request $request)
    {
     
        //$clientes = ClientesVentas::where("IdCampañaPersona",'like',$request->texto."%")->take(10)->get();
        $clientes = ClientesVentas::where('cedula','like',$request->texto."%")->take(10)->get();


        return view('Ventas.Bandeja.buscador.paginas', compact('clientes'));
    }

    public function agenda(Request $request)
    {
        
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
        $mes = $date->format('m');
        $ano = $date->format('Y');
        $dia = $date->format('d');
        $fecha_periodo="04-09-2019";
   
            /**total clientes  */
            $clientestocados = DB::connection('sqlsrv4')->select("SELECT  DISTINCT(COUNT(a.IdRegistroLlamada)) AS CLIENTES,b.Descripcion,a.IdCampaña
                                                        FROM tbRegistroLlamada as a, tbValorDetalle as b
                                                        WHERE  a.IdRespuesta=b.IdValorDetalle 
                                                        and a.UsuRegistro='$usuario'
                                                        and MONTH(a.FecRegistro) >= MONTH(GETDATE())
                                                        AND YEAR(a.FecRegistro) >=  YEAR(GETDATE())
                                                        GROUP BY a.UsuRegistro,b.Descripcion,a.IdCampaña
                                                     ");
            $TOTAL[] ="";
            $ventas[] ="";  
            $incompletas[] ="";  
            $interesados[] ="";  
            $fueraZ[] =""; 
            $noaplican[] =""; 
            $nodesea[] ="";   
            $llamar[] =""; 
            $pacificardventas[] =""; 
            $deprativentas[] =""; 

            /**
             * recorrido de la consulta para almacenar en una matriz los repectivos estados.
             */
            foreach ($clientestocados as  $clientestocado) {
                    
                    $TOTAL[] =   $clientestocado->CLIENTES;

                    if($clientestocado->Descripcion=='INTERESADO'){
                        $interesados[] =   $clientestocado->CLIENTES;
                    }

                    if($clientestocado->Descripcion=='FUERA DE ZONA'){
                        $fueraZ[] =   $clientestocado->CLIENTES;
                    }

                    if(substr($clientestocado->Descripcion, 0, 5)=='VENTA'  && $clientestocado->Descripcion!='VENTAS INCOMPLETAS'){
                        $ventas[] =   $clientestocado->CLIENTES;
                    }

                    if( $clientestocado->Descripcion=='VENTAS INCOMPLETAS'){
                        $incompletas[] =   $clientestocado->CLIENTES;
                    }

                    if($clientestocado->Descripcion=='NO APLICA'){
                        $noaplican[] =   $clientestocado->CLIENTES;
                    }

                    if($clientestocado->Descripcion=='NO DESEA'){
                        $nodesea[] =   $clientestocado->CLIENTES;
                    }


                    if(substr($clientestocado->Descripcion, 0, 6)=='VOLVER'){
                        $llamar[] =   $clientestocado->CLIENTES;
                    }

                    if($clientestocado->IdCampaña=='50' && substr($clientestocado->Descripcion, 0, 5)=='VENTA'  && $clientestocado->Descripcion!='VENTAS INCOMPLETAS'){
                        $pacificardventas[] =   $clientestocado->CLIENTES;
                    }

                    if($clientestocado->IdCampaña=='33' && substr($clientestocado->Descripcion, 0, 5)=='VENTA'  && $clientestocado->Descripcion!='VENTAS INCOMPLETAS'){
                        $deprativentas[] =   $clientestocado->CLIENTES;
                    }

                   
            }

          /**
           * suma de los respectivos estadps de la gestiones del mes
           */


            $totaltocados = array_sum($TOTAL);
            $interesados = array_sum($interesados);
            $fueraZ = array_sum($fueraZ);
            $ventas = array_sum($ventas);
            $noaplican = array_sum($noaplican);
            $nodesea = array_sum($nodesea);
            $llamar = array_sum($llamar);
            $pacificardventas = array_sum($pacificardventas);
            $deprativentas = array_sum($deprativentas);
            $incompletas = array_sum($incompletas);
       /**
        * puntos t porcentajes
        */

        $meta=850;
        $puntosPC = 3;
        $puntosDP = 2.8;

            $ttpuntospc =  $pacificardventas*$puntosPC;
            $pcporc     = round($ttpuntospc*100/$meta);

            $ttpuntosdp =  round($deprativentas*$puntosDP);
            $dpporc     = round($ttpuntosdp*100/$meta);

            $ttpuntos   = $ttpuntospc+$ttpuntosdp;
            $ttporc     = round($ttpuntos*100/$meta);

                /**total clientes agendados pendientes  */
              /*  $agendados = DB::connection('sqlsrv4')->select("SELECT  *,CONVERT(VARCHAR, hora, 108) horas 
                from DAMPLUSagenda where 
                users='$usuario' 
           
                and estado='A' order by fecha,hora   
                ");*/


           
            //dd($dpporc);

                    $datos = array(
                                'clientestocados'   => $totaltocados,
                                'interesados'       => $interesados,
                                'fueraZ'            => $fueraZ,
                                'ventas'            => $ventas,
                                'noaplican'         => $noaplican,
                                'nodesea'           => $nodesea,
                                'llamar'            => $llamar,
                                'incompletas'       => $incompletas,
                                'ventaspacificard'  => $pacificardventas,
                                'ventasdeprati'     => $deprativentas,
                                'ttpuntospc'        => $ttpuntospc,
                                'porcentajepc'      => $pcporc,
                                'ttpuntosdp'        => $ttpuntosdp,
                                'porcentajedp'      => $dpporc,
                                'ttpuntos'          => $ttpuntos,
                                'ttporcentajes'     => $ttporc//,
                               // 'agendados'         => $agendados
                             );

                  
                    return response()->json($datos);

    }

    

}
