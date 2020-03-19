<?php

namespace App\Http\Controllers\Predictivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ventas\DAMPLUSpredictivo;
use App\Models\Predictivo\Maxfecha;
use DB;
use Auth;
use Carbon\Carbon;
use App\flash;
class GestionesController extends Controller
{

    public function xxx(Request $request)
    {

        $maxfecha = DB::connection('asterisk')->select("SELECT fecha  as fecha from maxfecha"); 
        foreach($maxfecha as $maxfechas){
            $fechamax = $maxfechas->fecha;
           
        }
 
      //  dd( $maxfecha);
        /**consultar los list */
       
        $list = DB::connection('asterisk')->select(" SELECT 
                                                            a.USER              AS asesor,
                                                            a.user_group        AS grupo,
                                                            a.call_date         AS fecha,
                                                            b.first_name        AS cedula,
                                                            a.phone_number      AS telefono,
                                                            b.alt_phone         AS telefono_adicional,
                                                            b.security_phrase   AS telefono_parentesco,
                                                            b.middle_initial    AS nombre_parentesco,
                                                            b.gender            AS confirmacion,
                                                            b.comments          AS negociacion,
                                                            b.state             AS contacto,
                                                            a.`status`          AS estado,
                                                            a.campaign_id       AS campana,
                                                            a.list_id,
                                                            a.lead_id,
                                                            a.uniqueid,
                                                            b.title
                                                        FROM 
                                                            vicidial_log AS a, vicidial_list AS b 
                                                        WHERE 
                                                            a.lead_id=b.lead_id 
                                                        AND a.call_date >'$fechamax'  
         "); 
         // dd($list);

          foreach($list as $listss){
            $listtem = new DAMPLUSpredictivo();
            $listtem->asesor                = $listss->asesor;
            $listtem->grupo                 = $listss->grupo;
            $listtem->fecha                 = $listss->fecha;
            $listtem->cedula                = $listss->cedula;
            $listtem->telefono              = $listss->telefono;
            $listtem->telefono_adicional    = $listss->telefono_adicional;
            $listtem->telefono_parentesco   = $listss->telefono_parentesco;
            $listtem->nombre_parentesco     = $listss->nombre_parentesco;
            $listtem->confirmacion          = $listss->confirmacion;
            $listtem->negociacion           = $listss->negociacion;
            $listtem->contacto              = $listss->contacto;
            $listtem->estado                = $listss->estado;
            $listtem->campana               = $listss->campana;
            $listtem->list_id               = $listss->list_id;
            $listtem->uniqueid              = $listss->uniqueid;
            $listtem->title                 = $listss->title;
            $listtem->save();
        }
        
        $fechamax = DB::connection('sqlsrv4')->select("SELECT max(fecha)  as fecha from DAMPLUSpredictivo"); 
        foreach($fechamax as $fechamaxs){
            $fechamax = $fechamaxs->fecha;
           
        }
        $maxfecha = new Maxfecha();
        $maxfecha->fecha =  $fechamax;
        $maxfecha->update();
       // dd( $maxfecha);
 
        return redirect()->route('inicio')
        ->with('info', ' Loco se Ejecuto con  Éxito');
    }



    public function gestionesact(Request $request)
    {
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fechaactualizar = $date->format('Y-m-d');
      
       
        $gestiones = DB::connection('asterisk')->select(" SELECT 
                                                            a.USER              AS asesor,
                                                            a.user_group        AS grupo,
                                                            a.call_date         AS fecha,
                                                            b.first_name        AS cedula,
                                                            a.phone_number      AS telefono,
                                                            b.alt_phone         AS telefono_adicional,
                                                            b.security_phrase   AS telefono_parentesco,
                                                            b.middle_initial    AS nombre_parentesco,
                                                            b.gender            AS confirmacion,
                                                            b.comments          AS negociacion,
                                                            b.state             AS contacto,
                                                            a.`status`          AS estado,
                                                            a.campaign_id       AS campana,
                                                            a.list_id,
                                                            a.lead_id,
                                                            a.uniqueid,
                                                            b.title,
                                                            c.location
                                                        FROM 
                                                            vicidial_log AS a, vicidial_list AS b,recording_log as c
                                                          
                                                        WHERE 
                                                                a.lead_id=b.lead_id
                                                            AND a.uniqueid=c.vicidial_id    
                                                            AND a.call_date >='2019-10-01' 
                                                            AND a.`status`='ACT'
                                                            AND a.USER='$usuario'
                                                           
                                                            ORDER BY a.call_date DESC  
                                                            LIMIT 100
         "); 
            /**
    * traer los datos de la grabacion
    */
 
        
 
        return   view('Ventas.Bandeja.gestiones', compact('gestiones'));
    }

    public function ventasgrupo(Request $request)
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
            $agendados = DB::connection('sqlsrv4')->select("SELECT DISTINCT(count(cedula+campana)) as cantidad,users FROM DAMPLUSagenda where estado='A' group by users
            ORDER BY cantidad DESC 
                                                     ");
         
                    $datos = array(
                                'agendados'   => $agendados
                             
                             );

                  
                    return response()->json($datos);

    }


    public function ventasgrupos(Request $request)
    {
        
 
        return   view('Ventas.admin');
    }
}
