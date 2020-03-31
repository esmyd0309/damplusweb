<?php

namespace App\Http\Controllers\Cobranza\web;
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
class GestionesController extends Controller
{
   
    public function recaudacionesAdd(Request $request )
    {   
      $v = \Validator::make($request->all(), [
            
        'documento' => 'required|numeric',
        'origen' => 'required',
        'destino' => 'required',
        'formapago' => 'required',
        'valor' => 'required',
        'comentario' => 'required|min:20',
        'fechapago' => 'required',

    ]);

    if ($v->fails())
    {
        return redirect()->back()->withInput()->withErrors($v->errors());
    }
    $date = Carbon::now();
    $fecha= $date->format('Y-m-d H:i');
    $ano= $date->format('Y');
    $mes= $date->format('m');
    $dia= $date->format('d');


          $recaudo = new DAMPLUSWEBrecaudaciones();
          $recaudo->idc = $request->idc;
          $recaudo->cedula = $request->cedula;
          $recaudo->documento = $request->documento;
          $recaudo->fecha = $fecha;
          $recaudo->agente = \Auth::user()->usuario;
          $recaudo->origen = $request->origen;
          $recaudo->destino = $request->destino;
          $recaudo->formapago = $request->formapago;
          $recaudo->fechapago = $request->fechapago;
          $recaudo->valor = $request->valor;
          $recaudo->comentario = $request->comentario;

          $nombrear = $request->file('archivo')->getClientOriginalName();//obtengo el nombre del archivo
            $filename = pathinfo($nombrear, PATHINFO_FILENAME);//obtengo el nombre sin la extension
            $extension = pathinfo($nombrear, PATHINFO_EXTENSION);//obtengo la extension del archivo
            $nombre = $recaudo->documento.'_'.$recaudo->fechapago.'_'.$recaudo->cedula.'.'.$extension;//armo el nombre del archivo

          if ($request->archivo) {
            
          $destination = base_path() . '/public/recibos/'.$ano.'/'.$mes.'/'.$dia;//armo la ruta para la imagen
          $subirarchivo = $request->file('archivo')->move($destination, $nombre);//subo la imagen a la carpeta
          
          $recaudo->archivo = 'recibos/'.$ano.'/'.$mes.'/'.$dia.'/'.$nombre;
          $recaudo->nombreArchivo = $nombre;
          }
         

       
          $recaudo->save();

         

          return redirect()
                          ->back()
                          ->with('info', 'Recaudacion Agregada Correctamente..!');    
    }
    public function compromisoAdd(Request $request )
    {   

      $v = \Validator::make($request->all(), [
            
        'contacto' => 'required',
        'valor' => 'required',
        'formapago' => 'required',
        'tipocompromiso' => 'required',
        'comentario' => 'required|min:20',
        'fechapago' => 'required',

       ]);

      if ($v->fails())
      {
          return redirect()->back()->withInput()->withErrors($v->errors());
      }
      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');

      $fecha = Carbon::now();
      $tabla = new DAMPLUSWEBgestiones();
      $tabla->telefono = $request->contacto;
      $tabla->valor = $request->valor;
      $tabla->formapago = $request->formapago;
      $tabla->fechapago = $request->fechapago;
      $tabla->tipocompromiso = $request->tipocompromiso;
      $tabla->tipocontacto = $request->tipocontacto;
      $tabla->comentario = $request->comentario;
      $tabla->agente = \Auth::user()->usuario;
      $tabla->fecha = $fecha;
      $tabla->estado = 'compromiso';
      $tabla->idc = $request->idc;
      $tabla->cedula = $request->cedula;
      $tabla->save();

        return redirect()->back()->with('info', 'Compromiso Agregada Correctamente..!');    
    }
    public function gestionesAdd(Request $request )
    {   

        DD($request );
      $v = \Validator::make($request->all(), [
            
        'contacto' => 'required',
        'valor' => 'required',
        'formapago' => 'required',
        'tipocompromiso' => 'required',
        'comentario' => 'required|min:20',
        'fechapago' => 'required',

       ]);

      if ($v->fails())
      {
          return redirect()->back()->withInput()->withErrors($v->errors());
      }
      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');

      $fecha = Carbon::now();
      $tabla = new DAMPLUSWEBgestiones();
      $tabla->telefono = $request->contacto;
      $tabla->valor = $request->valor;
      $tabla->formapago = $request->formapago;
      $tabla->fechapago = $request->fechapago;
      $tabla->tipocompromiso = $request->tipocompromiso;
      $tabla->tipocontacto = $request->tipocontacto;
      $tabla->comentario = $request->comentario;
      $tabla->agente = \Auth::user()->usuario;
      $tabla->fecha = $fecha;
      $tabla->estado = 'compromiso';
      $tabla->idc = $request->idc;
      $tabla->cedula = $request->cedula;
      $tabla->save();

        return redirect()->back()->with('info', 'Compromiso Agregada Correctamente..!');    
    }

    public function gestionesweb(Request $request )
    { 
      dd($request );
    }
    
}
