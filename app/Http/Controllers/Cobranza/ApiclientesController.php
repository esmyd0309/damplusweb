<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use App\Models\Cobranza\web\DAMPLUSWEBgestiones;
use Carbon\Carbon;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\User;
use Auth;
use DB;
class ApiclientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {   

      // dd($request);
        $nombres = $request->get('nombres');
        $cedula = $request->get('cedula');

      //  
        $clientes=ApiClientes::orderBy('Identificacion', 'DESC')
        ->nombres($nombres)
        ->cedula($cedula)

        ->paginate(10);
     
        //dd($clientes);
        return view('cliente.index', compact('clientes'));
    }

    public function apiclientescobranza($datobuscar,$tipobuscar )
    {   
      if ($tipobuscar=="true") {
        return $clientes = DB::connection('mysql')->table('clientescobranza')
                  ->select('clientescobranza.idc',
                  'clientescobranza.cedula',
                  'clientescobranza.Nombres',
                  'clientescobranza.valordeuda',
                  'clientescobranza.saldodeuda',
                  'clientescobranza.descripcion',
                  'clientescobranza.agente',
                  'clientescobranza.area'
                  )
            ->where("clientescobranza.Nombres",'like',"%".$datobuscar."%")
            ->take(10)->get();
      
      }
      if ($tipobuscar=="false") {
       
        return $clientes = DB::connection('mysql')->table('clientescobranza')
                            ->select('clientescobranza.idc',
                            'clientescobranza.cedula',
                            'clientescobranza.Nombres',
                            'clientescobranza.valordeuda',
                            'clientescobranza.saldodeuda',
                            'clientescobranza.descripcion',
                            'clientescobranza.agente',
                            'clientescobranza.area'
                            )
                      ->where("clientescobranza.cedula",'like',$datobuscar."%")
                      ->take(10)->get();

      }
    


    }

    public function apiclientescobranzaguardar(Request $request )
    {   
      $fecha = Carbon::now();

      $tabla = new DAMPLUSWEBgestiones();
      $tabla->idc = $request->idc;
      $tabla->cedula = $request->cedula;
      $tabla->telefono = $request->telefono;
      $tabla->comentario = $request->comentario;
      $tabla->estado = $request->estado;
      $tabla->fechapagar = $request->fechapagar;
      $tabla->valor = $request->valor;
      $tabla->formapago = $request->forma;


      $tabla->agente = \Auth::user()->usuario;
      $tabla->fecha = $fecha;

      $tabla->save();

      return $tabla;

    }
    public function apiclientescobranzagestiones($idc )
    {  
      
       $clientes = DAMPLUSWEBgestiones::where('idc',$idc)->get();
        return $clientes;
    }
}
