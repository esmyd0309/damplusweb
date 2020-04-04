<?php

namespace App\Http\Controllers\Cobranza\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\User;
use Auth;
use DB;

class EstadosController extends Controller
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
    public function index(Request $request )
    {   
        $estados=DB::connection('mysql')->table('estados')
                                        ->select('estados.*')
                                        ->orderBy('fecha', 'desc')
                                        ->get();
        return view('Cobranza.contactos.web.estados',compact('estados'));
    }

}