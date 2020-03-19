<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ventas\GestionesVentas;
use Auth;
use DB;
class GestionesController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	} 
    public function sanear_string($string)
    {
 
            $string = trim($string);
        
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );
        
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );
        
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
 
    
 
 
        return $string;
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $user = Auth::user();
        $usuario = $user->usuario;

        
        $LIM = DB::connection('sqlsrv4')->statement("TRUNCATE TABLE  TEMPV"); 
        $INSERT = DB::connection('sqlsrv4')->statement("INSERT INTO TEMPV
                                                        SELECT IdCampañaPersona FROM tbRegistroLlamada WHERE
                                                        IdRespuesta IN ('1009',
                                                        '1012',
                                                        '1002',
                                                        '1005',
                                                        '3002',
                                                        '3001',
                                                        '3003',
                                                        '1007',
                                                        '1006',
                                                        '1018',
                                                        '1022',
                                                        '1019',
                                                        '1023',
                                                        '1021',
                                                        '1020',
                                                        '1024',
                                                        '1013') AND IdCampaña='50' AND MONTH(FecRegistro) >=  MONTH(FecRegistro)-4 AND  YEAR(FecRegistro) =  YEAR(convert(date,getdate()))
                                                        "); 

        $interesados = DB::connection('sqlsrv4')->select("SELECT * FROM tbRegistroLlamada 
                                                    where usuRegistro='$usuario' 
                                                    AND IdCampaña='50' 
                                                    AND IdRespuesta='6003' 
                                                    AND IdCampañaPersona NOT IN (
                                                    SELECT IdCampañaPersona FROM TEMPV)
                                                    AND MONTH(FecRegistro) >=  MONTH(FecRegistro)-4 
                                                    AND  YEAR(FecRegistro) =  YEAR(convert(date,getdate()))
                                                    "); 
                                                            

        
      
        
                    //dd($IN);
        return view('Ventas.Clientes.index',compact('interesados'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gestionespredictivo()
    {
        $TRUNCATE = DB::connection('asterisk')->statement
        ("
            TRUNCATE TABLE BD_INDICADOR_CONTACTO_TEM
        ");

        $INSERT = DB::connection('asterisk')->statement
        ("
            INSERT INTO BD_INDICADOR_CONTACTO_TEM
            SELECT * FROM vicidial_log WHERE call_date >=   CURDATE()
        ");

        $INSERT2 = DB::connection('asterisk')->statement
        ("
            INSERT INTO BD_INDICADOR_CONTACTO
            SELECT * FROM BD_INDICADOR_CONTACTO_TEM WHERE uniqueid NOT IN (
            SELECT uniqueid FROM BD_INDICADOR_CONTACTO)
        ");

        $A = DB::connection('asterisk')->statement
        ("
        UPDATE DAMPLUSgestionesDIA AS T1,
              (SELECT COUNT(uniqueid) AS CANTIDAD, USER
                FROM BD_INDICADOR_CONTACTO 
                GROUP BY USER ) AS T2
                 
          SET T1.CANTIDAD=T2.CANTIDAD
        WHERE T1.USER = T2.USER");

        $B = DB::connection('asterisk')->statement
        ("
            UPDATE DAMPLUSgestionesDIA AS T1,
                (SELECT COUNT(uniqueid) AS CANTIDAD, USER
                    FROM BD_INDICADOR_CONTACTO 
                    WHERE STATUS IN ('ACT','EF','DNC','NAP','FZ','FLL','SALE','SALET','CMP','CMPT','RECD','RECDT') GROUP BY USER ) AS T2
                    
            SET T1.efectivos=T2.CANTIDAD
            WHERE T1.USER = T2.USER
        ");

        $C = DB::connection('asterisk')->statement
        ("
            UPDATE DAMPLUSgestionesDIA AS T1,
                (SELECT COUNT(uniqueid) AS CANTIDAD, USER
                    FROM BD_INDICADOR_CONTACTO 
                    WHERE STATUS IN ('SALE','SALET') GROUP BY USER ) AS T2
                    
            SET T1.ventas=T2.CANTIDAD
            WHERE T1.USER = T2.USER 
        ");

        $D = DB::connection('asterisk')->statement
        ("
        
            UPDATE DAMPLUSgestionesDIA AS T1,
                (SELECT COUNT(uniqueid) AS CANTIDAD, USER
                    FROM BD_INDICADOR_CONTACTO 
                    WHERE STATUS IN ('CMP','CMPT') GROUP BY USER ) AS T2
                    
            SET T1.compromisos=T2.CANTIDAD
            WHERE T1.USER = T2.USER
        ");

        $E = DB::connection('asterisk')->statement
        ("
            UPDATE DAMPLUSgestionesDIA SET efectividad=efectivos/NULLIF(CANTIDAD,0) WHERE USER=USER
        ");

     /*   $F = DB::connection('asterisk')->statement
        ("
            UPDATE DAMPLUSgestionesDIA SET productividad=ISNULL(ventas/NULLIF(efectivos,0), 1) WHERE USER=USER
        ");

        $G = DB::connection('asterisk')->statement
        ("
            UPDATE DAMPLUSgestionesDIA SET productividad=ISNULL(compromisos/NULLIF(efectivos,0), 1) WHERE USER=USER
        ");
       */

        $SELECT = DB::connection('asterisk')->SELECT("SELECT * FROM DAMPLUSgestionesDIA ");

        DD($SELECT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
