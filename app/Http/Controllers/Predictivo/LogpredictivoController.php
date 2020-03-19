<?php

namespace App\Http\Controllers\Predictivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Predictivo\Logpredictivo;
class LogpredictivoController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {   
       
        $telefono = $request->get('telefono');
        $cedula = $request->get('cedula');
        $status = $request->get('status');
        
       
        $logredictivos=Logpredictivo::whereNotIn('status',['A','EQV','B'])->orderBy('call_date', 'DESC')
        
        ->telefono($telefono)
        ->cedula($cedula)
        ->status($status)
      
        ->paginate(15);
     
        //dd($dependents);
        return view('Predictivo.Log_telefonos.index', compact('logredictivos'));

    
    
    }
   
}
