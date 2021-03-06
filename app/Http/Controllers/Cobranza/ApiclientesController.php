<?php

namespace App\Http\Controllers\Cobranza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use App\Models\Cobranza\web\DAMPLUSWEBgestiones;
use App\Models\Cobranza\web\DAMPLUSWEBrecaudaciones;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $idc = $request->get('idc');

      //  
        $clientes=ApiClientes::orderBy('idc', 'DESC')
        ->nombres($nombres)
        ->idc($idc)

        ->paginate(10);
     
        //dd($clientes);
        return view('clientes.cliente.index', compact('clientes'));
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


   
    public function apiclientescobranzagestiones($idc)
    {  
      
       $clientes = DAMPLUSWEBgestiones::where('idc',$idc)->get();
        return $clientes;
    }

    public function datosclienteweb($idc)
    {  
      
       $clientes = DB::connection('mysql')->table('clientescobranza')
      ->select('clientescobranza.*')
      ->where("clientescobranza.idc",$idc)
      ->get();
      return $clientes;
      
    }

    public function bancos()
    {  
      
       $bancos = DB::connection('mysql')->table('bancos')
      ->select('bancos.nombre')
      ->get();
      return $bancos;
      
    }

    public function recaudacion($idc )
    {  
      
      return view('web.cobranza.recaudaciones',compact('idc'));
    }
    
}
