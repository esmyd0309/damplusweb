<?php

namespace App\Http\Controllers\Cobranza\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\web\DAMPLUSWEBcontactos;
use App\Models\Cobranza\web\DAMPLUSWEBtelefonos;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\User;
use Auth;
use Carbon\Carbon;

class ContactosController extends Controller
{
    public function sanear_string($string)
    {
 
            $string = trim($string);
        
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );
        
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );
        
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );

            $string = str_replace(
                array('/', '*', '$', '-', '_', '.', '?', '%', '#', '+', '!', '=', ' ', '(', '&', '¡', '|', ',', ':', '´', '°', '¿', ')' ),
                array('', '', '', '','','','','','','','','','','','','','','','','','',''),
                $string
            );
 
    
 
 
        return $string;
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactosAdd(Request $request )
    {   
        $request->numero = $this->sanear_string($request->numero);
        

        $v = \Validator::make($request->all(), [
            
            'numero' => 'required|digits_between:7,9',
            'prefijo' => 'required',
            'tipo' => 'required',
            'contacto' => 'required',
            'referencia' => 'required',
        ]);


          


        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $date = Carbon::now();
        $fecha= $date->format('Y-m-d H:i');

        $telefono = new DAMPLUSWEBtelefonos();
        $telefono->cedula       = $request->cedula;
        $telefono->prefijo      = $request->prefijo;
        $telefono->numero       = $request->numero;
        $telefono->telefono     = $request->prefijo.$telefono->numero;
        $telefono->tipo         = $request->tipo;
        $telefono->contacto     = $request->contacto;
        $telefono->referencia   = $request->referencia;
        $telefono->observacion  = $request->observacion;
        $telefono->fecha = $fecha;
        $telefono->agente = \Auth::user()->usuario;
        $telefono->save();

        return redirect()
                          ->back()
                          ->with('info', 'Telefono Agregada Correctamente..!');
    }

}