<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\User;
use Auth;
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
}
