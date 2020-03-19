<?php

namespace App\Http\Controllers\Operaciones;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use DB;
use DateTime;
use App\Exports\RechazosExport;
use App\Models\Operaciones\Rechazos;
class RechazosControlle extends Controller
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
        return view('Operaciones.rechazos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportar(Request $request)
    {
        $fechadesde = $request->fechadesde;
        $fechahasta = $request->fechahasta;

        $date = new DateTime(); 
        $d= $date->format('Y-m-d H:i:s');
        
        return (new RechazosExport($fechadesde,$fechahasta))->download($d .'Rechazos.xls');
     

    
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
