<?php

namespace App\Http\Controllers\Cobranza\web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\ApiClientes;
use App\Models\Cobranza\web\DAMPLUSWEBgestiones;
use App\Models\Cobranza\web\DAMPLUSWEBrecaudaciones;
use App\Models\Cobranza\web\DAMPLUSWEBestados;
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
      
      $idcampana =  $request->idcampana.$request->cedula;
      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');

      $fecha = Carbon::now();
      $tabla = new DAMPLUSWEBgestiones();
      $tabla->fecha = $fecha;
      $tabla->agente = \Auth::user()->usuario;
      $tabla->idc = $idcampana;
      $tabla->cedula = $request->cedula;

      if ($request->telefono) {
        $tabla->telefono = $request->telefono;
      }else{
        $tabla->telefono = $request->prefijo.$request->numero;

      }
      $tabla->estado = $request->estado;
      $tabla->comentario = $request->comentario;
      $tabla->contacto = $request->contacto;
      $tabla->direccion = $request->terreno;
      $tabla->prefijo = $request->prefijo;
      $tabla->numero = $request->numero;
      $tabla->respuestasms = $request->respuestasms;
      $tabla->repuestawhatsapp = $request->repuestawhatsapp;
      $tabla->respuestaemail = $request->respuestaemail;
      $tabla->mensajeenviado = $request->mensajeenviado;
      $tabla->posicion = $request->posicion;
      $tabla->causa = $request->causa;
      $tabla->idcampana = $idcampana;

      $tabla->mensajerespuesta = $request->mensajerespuesta;

      
      $tabla->save();

        return redirect()->back()->with('info', 'Gestion Agregada Correctamente..!');    
    }
    public function getgestiones($idc)
    {  
      $gestiones = DB::connection('mysql')->table('DAMPLUSWEBgestiones')
      ->select(
                'DAMPLUSWEBgestiones.fecha',
                'DAMPLUSWEBgestiones.estado',
                'DAMPLUSWEBgestiones.contacto',
                'DAMPLUSWEBgestiones.telefono',
                'DAMPLUSWEBgestiones.comentario',
                'DAMPLUSWEBgestiones.agente'

              )
      ->where("DAMPLUSWEBgestiones.idc",$idc)
      ->where("DAMPLUSWEBgestiones.estado",'!=','compromiso')
      ->orderBy('fecha', 'desc')

      ->get();
      
       return response()->json($gestiones);
    }

    public function getcompromisos($idc)
    {  
      $gestiones = DB::connection('mysql')->table('DAMPLUSWEBgestiones')
      ->select(
                'DAMPLUSWEBgestiones.fecha',
                'DAMPLUSWEBgestiones.estado',
                'DAMPLUSWEBgestiones.contacto',
                'DAMPLUSWEBgestiones.telefono',
                'DAMPLUSWEBgestiones.comentario',
                'DAMPLUSWEBgestiones.agente'

              )
      ->where("DAMPLUSWEBgestiones.idc",$idc)
      ->where("DAMPLUSWEBgestiones.estado",'compromiso')
      ->orderBy('fecha', 'desc')

      ->get();
      
       return response()->json($gestiones);
    }

    public function getrecaudaciones($idc)
    {  
      $gestiones = DB::connection('mysql')->table('dampluswebrecaudaciones')
      ->select(
                'dampluswebrecaudaciones.fecha',
                'dampluswebrecaudaciones.documento',
                'dampluswebrecaudaciones.agente',
                'dampluswebrecaudaciones.formapago',
                'dampluswebrecaudaciones.fechapago',
                'dampluswebrecaudaciones.valor',
                'dampluswebrecaudaciones.comentario',
                'dampluswebrecaudaciones.archivo'
              )
      ->where("dampluswebrecaudaciones.idc",$idc)
      ->orderBy('fecha', 'desc')

      ->get();
      
       return response()->json($gestiones);
    }
  
    public function estadosAdd(Request $request )
    {   
      $date = Carbon::now();
      $fecha= $date->format('Y-m-d H:i');

      $estados = new DAMPLUSWEBestados();
      $estados->fecha = $fecha;
      $estados->agente = \Auth::user()->usuario;
      $estados->nombre = $request->nombre;
      $estados->descripcion = $request->descripcion;
      $estados->estado = $request->estado;
      $estados->tipo = $request->tipo;
      $estados->grupo = $request->grupo;
      $estados->save();

        return redirect()->back()->with('info', 'Estado Agregada Correctamente..!');    
    }

    public function getgrupoestados()
    {  
      $grupoestados = DB::connection('mysql')->table('dampluswebgruposestados')
      ->select('dampluswebgruposestados.*')
      ->get();
      
       return response()->json($grupoestados);
    }

    public function getestados()
    {  
      $estados = DB::connection('mysql')->table('estados')
      ->select('estados.*')
      ->where('grupo',2)
      ->where('estado',1)
      ->get();
      
       return response()->json($estados);
    }

    public function getposicion()
    {  
      $posicion = DB::connection('mysql')->table('estados')
      ->select('estados.*')
      ->where('grupo',5)
      ->where('estado',1)
      ->get();
      
       return response()->json($posicion);
    }
   
    
}
