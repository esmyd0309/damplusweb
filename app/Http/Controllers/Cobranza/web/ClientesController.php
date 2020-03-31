<?php

namespace App\Http\Controllers\Cobranza\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\User;
use Auth;
class ClientesController extends Controller
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
        return view('web.cobranza.gestiones.index');
    }

}