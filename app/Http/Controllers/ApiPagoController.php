<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin\Pago;
use App\Models\Admin\DetallePago;
use App\Models\Cobranza\cuotas\DAMPLUSWEBcuotadetalle;
use Carbon\Carbon;
use App\User;
use Auth;
use DB;

class ApiPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) 
        {
            $pagos = Pago::with('user')
                ->campania($request->get('id'))
                ->orderBy('id', 'asc')
                ->get();

            return response()->json($pagos, 200);
        }

        return response()->json([], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {      
            
            $date = Carbon::now();
            $fecha= $date->format('Y-m-d H:i');

            $pago = new Pago();
                        
            /*
                Creando el pago
            */       
            $pago->campania_idc = $request->campania_idc;
            $pago->periodo = $request->periodo;
            $pago->interes = $request->interes;
            $pago->cuota = $request->cuota;
            $pago->abono = $request->abono;
            $pago->fecha_pago = $request->fecha_pago;
            $pago->saldodeuda = $request->saldoDeuda;
            $pago->user_id = \Auth::user()->id;
            $pago->fecha_registro = $fecha;

            $pago->save();


            /*
                Primer periodo de amortización
            */
            /*$detalle_pago = new DetallePago(); 
            $detalle_pago->pago_id = $pago->id;
            $detalle_pago->saldo_inicial = $request->monto_cobrar;
            $detalle_pago->cuota_fija = 0;
            $detalle_pago->fecha_pago = date("Y-m-d", strtotime($request->fecha_pago."+ 1 month"));
            $detalle_pago->user_id = \Auth::user()->id;

            $detalle_pago->save();*/

            /*
                Primer periodo de amortización
            */

            $data = $request->detalleCuota;

            for($i = 0; $i < count($data); $i++){
                
                $cuotadetalle = new DAMPLUSWEBcuotadetalle();
                $cuotadetalle->cuota_id = $pago->id;
                $cuotadetalle->periodo = $data[$i]['id'];
                $cuotadetalle->saldo_inicial = $data[$i]['saldo_inicial'];
                $cuotadetalle->interes = $data[$i]['interes'];
                $cuotadetalle->cuota = $data[$i]['cuota'];
                $cuotadetalle->abono = $data[$i]['abono'];
                $cuotadetalle->fecha_pago = $data[$i]['fecha_pago'];
                $cuotadetalle->saldo_final = $data[$i]['saldo_final'];
                $cuotadetalle->asesor = \Auth::user()->usuario;
                $cuotadetalle->fecha_registro = $fecha;
                $cuotadetalle->estado = 1;
                $cuotadetalle->save();
       
            }
            
            return response()->json(['success' => 'Estimado usuario, el cliente '.$request->nombres.' tiene una deuda de '.$request->valorDeuda.' en la campaña de '.$request->campania.', con un saldo de $'.$request->saldoDeuda.' menos el abono $'.($request->saldoDeuda - $request->abono).', los pagos los efectuará al cabo de '.$request->periodo.' mes(es), con una cuota de $'.round($pago->cuota, 3).', su primer pago lo debe realizar a partir del '.date('d/m/Y', strtotime($pago->fecha_pago."+ 1 month"))], 202);
        }
        catch(Exception $e)
        {
           return response()->json(['errores' => 'Lo sentimos se ha presentado un problema interno en el servidor'], 500);
        }
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
        $pago = Pago::findOrFail($id);
        $pago->delete();
        return response()->json(['success' => 'Se ha eliminado el plan de pago!!']);
    }
}
