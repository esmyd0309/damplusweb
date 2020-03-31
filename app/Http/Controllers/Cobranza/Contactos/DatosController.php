<?php

namespace App\Http\Controllers\Cobranza\Contactos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Contactos\Ruc;
use App\Models\Cobranza\Contactos\Agua;
use App\Models\Cobranza\Contactos\Datos;
use App\Models\Cobranza\Contactos\Deudor;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Cobranza\Contactos\Medidor;
use App\Models\Cobranza\Contactos\Trabajo;
use App\Models\Cobranza\Contactos\Telefonos;
use App\Models\Cobranza\web\DAMPLUSWEBtelefonos;

use DB;
use App\Models\Cobranza\DAMPLUStelefonos;
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
    public function index()
    {
        return view('Cobranza.Contactos.index');
    }

    
    public function show($idc,$ced)
    {
       
        /**
         * buscar datos del cliente en tbcampañaPersona
         */
        $datos          = ClientesCobranza::where('idc',$idc)->first();
        /**
         * busco los datos relacionados al cliente en la tabla TBL_CLIENTE
         */
        $datosgenerales = Datos::where('cedula',$ced)->first();
        
    

        /**
         * busco los datos relacionados al cliente en la tablA TBL_RUC
         */
       // $ruc            = Ruc::where('CEDULA',$ced)->first();
        /**
         * busco los datos relacionados al cliente en la tabla TBL_TELEFONOS
         */
        $telefonos      = Telefonos::where('CEDULA',$ced)->get();
        /**
         * busco los datos relacionados al cliente en la tabla TBL_TRABAJO
         */
       // $trabajo        = Trabajo::where('CEDULA',$ced)->first();

         /**
         * busco los datos relacionados al cliente en la tabla TBL_MEDIDOR
         */
       // $medidor        = Medidor::where('CEDULA',$ced)->first();

        /**
         * busco los datos relacionados al cliente en la tabla TBL_MEDIDOR
         */
      //  $agua        = Agua::where('CEDULA',$ced)->first();
    
        /**
         * busco la cedulas de los parentescos en TBL_PARENTESCO
         */
      //  $cedula_parientes   = Deudor::select('CED_PARIENETE')->where('CED_DEUDOR',$ced)->DISTINCT('CED_PARIENETE')->get();

      /*  $cedulas_parentescos[]="";
        foreach ($cedula_parientes as  $parentesco) {
        $cedulas_parentescos[] =$parentesco->CED_PARIENETE;
        }
        */

        
  

/**
 * Buscar Datos de Parenntescos 
 */
       /* $telefonosparentescos = Datos::select(
                                                'TBL_TELEFONOS.TLF_FIJO1',
                                                'TBL_TELEFONOS.TLF_FIJO2',	
                                                'TBL_TELEFONOS.TLF_FIJO3',	
                                                'TBL_TELEFONOS.TLF_FIJO4',
                                                'TBL_TELEFONOS.CEL1_NVO1',	
                                                'TBL_TELEFONOS.CEL2_NVO1',	
                                                'TBL_TELEFONOS.CEL3_NVO1',	
                                                'TBL_TELEFONOS.CEL4_NVO1',	
                                                'TBL_TELEFONOS.CEL5_NVO1',
                                                'TBL_TELEFONOS.CEL6_NVO1',	
                                                'TBL_TELEFONOS.CEL7_NVO1',	
                                                'TBL_TELEFONOS.CEL8_NVO1',
                                                
                                                'TBL_CLIENTE.cedula',	
                                                'TBL_CLIENTE.NOMBRES',	
                                                'TBL_CLIENTE.DES_CIUDADANIA',	
                                                'TBL_CLIENTE.FECH_NAC',	
                                                'TBL_CLIENTE.edad',	
                                                'TBL_CLIENTE.DES_NACIONALID',	
                                                'TBL_CLIENTE.DES_ESTADO_CIVIL',	
                                                'TBL_CLIENTE.DES_PROFESION',	
                                                'TBL_CLIENTE.prov',	
                                                'TBL_CLIENTE.ciudad',	
                                                'TBL_CLIENTE.direc_cedula',

                                                'TBL_PARENTESCO.CED_DEUDOR',	
                                                'TBL_PARENTESCO.CED_PARIENETE',	
                                                'TBL_PARENTESCO.DESC_PARIENTE'
                                            )
                                        ->join('TBL_PARENTESCO', 'TBL_PARENTESCO.CED_PARIENETE', '=', 'TBL_CLIENTE.cedula')
                                        ->join('TBL_TELEFONOS', 'TBL_TELEFONOS.CEDULA', '=', 'TBL_PARENTESCO.CED_PARIENETE')
                                        ->whereIn('TBL_TELEFONOS.CEDULA',$cedulas_parentescos)
                                        ->where('TBL_PARENTESCO.CED_DEUDOR',$ced)
                                        ->orderBy('TBL_PARENTESCO.DESC_PARIENTE', 'DESC')
                                        ->get();

                                        $trabajoparientes = Datos::select(
                                            'TBL_TRABAJO.*',
                                            'TBL_PARENTESCO.*',
                                            'TBL_CLIENTE.*'
                                            )
                                                ->join('TBL_PARENTESCO', 'TBL_PARENTESCO.CED_PARIENETE', '=', 'TBL_CLIENTE.cedula')
                                                ->join('TBL_TRABAJO', 'TBL_TRABAJO.CEDULA', '=', 'TBL_PARENTESCO.CED_PARIENETE')
                                                ->whereIn('TBL_TRABAJO.CEDULA',$cedulas_parentescos)
                                                ->where('TBL_PARENTESCO.CED_DEUDOR',$ced)
                                                ->orderBy('TBL_PARENTESCO.DESC_PARIENTE', 'DESC')
                                                ->get();

                                                $RUCparientes = Datos::select(
                                                    'TBL_RUC.*',
                                                    'TBL_PARENTESCO.*',
                                                    'TBL_CLIENTE.*'
                                                    )
                                                        ->join('TBL_PARENTESCO', 'TBL_PARENTESCO.CED_PARIENETE', '=', 'TBL_CLIENTE.cedula')
                                                        ->join('TBL_RUC', 'TBL_RUC.CEDULA', '=', 'TBL_PARENTESCO.CED_PARIENETE')
                                                        ->whereIn('TBL_RUC.CEDULA',$cedulas_parentescos)
                                                        ->where('TBL_PARENTESCO.CED_DEUDOR',$ced)
                                                        ->orderBy('TBL_PARENTESCO.DESC_PARIENTE', 'DESC')
                                                        ->get();
      
                                                    */

        

                        $bancos = DB::connection('mysql')
                        ->table('bancos')
                        ->select('bancos.nombre')
                        ->get();
                        $formas_pagos = DB::connection('mysql')
                        ->table('formas_pagos')
                        ->select('formas_pagos.nombre')
                        ->get();

        $telefonosagregados = DAMPLUSWEBtelefonos::where('cedula',$ced)->get();
      // dd($telefonosagregados);
        return view('Cobranza.Contactos.show',compact('datos','datosgenerales','telefonos','idc','bancos','formas_pagos','telefonosagregados'));
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
