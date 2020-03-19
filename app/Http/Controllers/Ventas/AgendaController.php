<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ventas\ClientesVentas;
use App\Models\Ventas\Damplusagenda;
use App\Models\Ventas\DAMPLUSagendadetalle;
use App\User;
use App\Models\Admin\Genero;
use Auth;
use Carbon\Carbon;
use App\flash;
use Datatables;
use DB;
use last;
use Freshbitsweb\Laratables\Laratables;
class AgendaController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
 
   
    public function store(Request $request)
    {
        
        $v = \Validator::make($request->all(), [
            
            'telefonoContacto' => 'required|digits_between:9,10|numeric',
            'contacto' => 'required|string',
            'telefonoNuevo' => 'digits_between:9,10|numeric',
            'fecha' => 'required',
            'turno' => 'required',
            'comentario' => 'required|min:20',
        ]);


          


        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
      
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fechaacregisto= $date->format('Y-m-d H:i:s');
        $actualizado= $date->format('d-m-Y H:i');
        $registro= $date->format('d-m-Y H:i');
        $fechaactualizar = $date->format('Y-m-d');
        $horahoy= $date->format('H:i');

        $tresMese = date("Y-m-d",strtotime($date."+ 50 day"));

        $existe = Damplusagenda::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)
        ->where('fecha','>',$fechaactualizar)->first();

        $OPERACIONES = Damplusagendadetalle::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)
        ->where('estado','O')->first();

        $vencido = Damplusagendadetalle::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)
        ->where('estado','x')->first();


        if(!is_null($vencido) ){
            return redirect()->back()->with('infofecha', '  Cliente Ya se encuentra Vencido..!  ');
        }
        if(!is_null($OPERACIONES) ){
            return redirect()->back()->with('infofecha', 'Cliente Ya se encuentra en el area de Operaciones..!');
        }
        if(!is_null($existe) ){
      
            return redirect()->back()->with('info', 'Cliente Ya cuenta con una Agenda Vigente..!');
         }
        if ($request->fecha < $fechaactualizar  ) {
            return redirect()->back()->with('infofecha', 'La fecha no es valida, Ingrese una fecha Para llamar');
        }

        if ($request->fecha > $tresMese  ) {
            return redirect()->back()->with('infofecha', 'La fecha no es valida, Extiende el nivel del Lote');
        }
        
    
     

    
     //DD($OPERACIONES);
    /**
      * DAMPLUSagenda REPRESENTA LA TABLA DE REGISTRO UNICO Y LA ULTIMA GESTION DE LA AGENDA
      */
     $cliente = DAMPLUSagendadetalle::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)->first();

    //DD($cliente );
     /**
      * DAMPLUSagenda REPRESENTA LA TABLA DE REGISTRO DE GESTIONES
      */
     $id = DAMPLUSagenda::select("id")->where('idc',$request->IdCampaña.$request->IdCampañaPersona)->pluck('id')->last();
    /**
     * Si el cliente no existe en la AgendaDetalle lo agrego
     */
     if(is_null($cliente) )
     {
        

        $agenda = new DAMPLUSagendadetalle;
        $agenda->idc                =   $request->IdCampaña.$request->IdCampañaPersona; 
        $agenda->estado             =   'A'; 
        $agenda->users              =   $usuario; 
        $agenda->cedula             =   $request->IdCampañaPersona; 
        $agenda->nombres            =   $request->nombres; 
        $agenda->campanadescripcion =   $request->campanadescripcion; 
        $agenda->campana            =   $request->IdCampaña; 
        $agenda->telefonoContacto   =   $request->telefonoContacto; 
        $agenda->contacto           =   $request->contacto; 
        $agenda->telefonoNuevo      =   $request->telefonoNuevo; 
        $agenda->contactarcel       =   $request->contactarcel; 
        $agenda->codigoArea         =   $request->codigoArea;
        $agenda->convencional       =   $request->convencional; 
        $agenda->contactarconv      =   $request->contactarconv; 
        $agenda->turno              =   $request->turno; 
        $agenda->comentario         =   $request->comentario; 
        $agenda->fecha              =   $request->fecha;
        $agenda->hora               =   $request->hora;
        $agenda->registrado         =   $registro;
        // $agenda->updated_at         =   $fechaactualizar;
        $agenda->fecharegistroInicial = $registro;
        $agenda->save();
       
     }else {

    /**
     * Si el cliente  existe en la AgendaDetalle lo actualizo
     */
    
        $idagenda = $cliente->id;

        $estados = array('A','V');
        $fechaactualizado     = DAMPLUSagenda::where('id',$id)->whereIn('estado',$estados)->update(['actualizado'       => $actualizado]);
        $usuarioactualizado   = DAMPLUSagenda::where('id',$id)->whereIn('estado',$estados)->update(['actualizado_users' => $usuario]);
        $ESTADOAGENDA         = DAMPLUSagenda::where('id',$id)->whereIn('estado',$estados)->update(['estado'            => 'R']);


        $usuarioreag        = DAMPLUSagendadetalle::where('id',$idagenda)->update(['users'         =>  $usuario ]);
        $estado             = DAMPLUSagendadetalle::where('id',$idagenda)->update(['estado'         => 'A']);
        $fecha              = DAMPLUSagendadetalle::where('id',$idagenda)->update(['fecha'          => $request->fecha]);
        $comentario         = DAMPLUSagendadetalle::where('id',$idagenda)->update(['comentario'     => $request->comentario]);
        $fecha              = DAMPLUSagendadetalle::where('id',$idagenda)->update(['hora'           => $request->hora]);
        $registrado         = DAMPLUSagendadetalle::where('id',$idagenda)->update(['registrado'     => $registro]);
        $actualizado_users  = DAMPLUSagendadetalle::where('id',$idagenda)->update(['actualizado_users'  => $usuario]);
        $telefonoContacto   = DAMPLUSagendadetalle::where('id',$idagenda)->update(['telefonoContacto' => $request->telefonoContacto]);
        $contacto           = DAMPLUSagendadetalle::where('id',$idagenda)->update(['contacto'     => $request->contacto]);
        $telefonoNuevo      = DAMPLUSagendadetalle::where('id',$idagenda)->update(['telefonoNuevo' => $request->telefonoNuevo]);
        $contactarcel       = DAMPLUSagendadetalle::where('id',$idagenda)->update(['contactarcel' => $request->contactarcel]);
        $codigoArea         = DAMPLUSagendadetalle::where('id',$idagenda)->update(['codigoArea'   => $request->codigoArea]);
        $convencional       = DAMPLUSagendadetalle::where('id',$idagenda)->update(['convencional' => $request->convencional]);
        $contactarconv      = DAMPLUSagendadetalle::where('id',$idagenda)->update(['contactarconv' => $request->contactarconv]);
        $turno              = DAMPLUSagendadetalle::where('id',$idagenda)->update(['turno'        => $request->turno]);
        $actualizado        = DAMPLUSagendadetalle::where('id',$idagenda)->update(['actualizado'  => $actualizado]);
        $dias               = DAMPLUSagendadetalle::where('id',$idagenda)->update(['dias'  => '0']);
        $idagenda           = DAMPLUSagendadetalle::where('id',$idagenda)->update(['idagenda'  => $id]);
     
     }

       
       
        

        $agendax = new Damplusagenda;
        $agendax->idc                =   $request->IdCampaña.$request->IdCampañaPersona; 
        $agendax->estado             =   'A'; 
        $agendax->users              =   $usuario; 
        $agendax->cedula             =   $request->IdCampañaPersona; 
        $agendax->nombres            =   $request->nombres; 
        $agendax->campanadescripcion =   $request->campanadescripcion; 
        $agendax->campana            =   $request->IdCampaña; 
        $agendax->telefonoContacto   =   $request->telefonoContacto; 
        $agendax->contacto           =   $request->contacto; 
        $agendax->telefonoNuevo      =   $request->telefonoNuevo; 
        $agendax->contactarcel       =   $request->contactarcel; 
        $agendax->codigoArea         =   $request->codigoArea;
        $agendax->convencional       =   $request->convencional; 
        $agendax->contactarconv      =   $request->contactarconv; 
        $agendax->turno              =   $request->turno; 
        $agendax->comentario         =   $request->comentario; 
        $agendax->fecha              =   $request->fecha;
        $agendax->hora               =   $request->hora;
        // $agendax->updated_at         =   $fechaactualizar;
        $agendax->registrado         =   $registro;
        $agendax->fecharegistroInicial = $registro;
        $agendax->save();

        return redirect()->route('agenda.index')
        ->with('info', 'Cliente Agendado Correctamente..!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSimpleDatatablesData()
    {

        $agenda = DB::table('DAMPLUSagenda')->select('*');
        return datatables()->of($agenda)
            ->make(true);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $agendar = DAMPLUSagenda::where('id',$id)->first();
        $ced = $agendar->cedula;
        $idc = $agendar->campana;
      
        $datos = DB::connection('sqlsrv4')->table('tbCampañaPersona')
            ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
            ->select('tbCampañaPersona.*',
                      'tbCampaña.Descripcion',
                      'tbCampañaPersona.IdCampaña')
                       ->where('tbCampañaPersona.IdCampañaPersona',$ced)
                      ->where('tbCampañaPersona.IdCampaña',$idc)
            ->first();
      
        $gestiones = DB::connection('sqlsrv4')->select("SELECT   
                                                            c.IdCampañaPersona as cedula,
                                                            c.Campo2 as nombres,
                                                            a.Contacto,
                                                            a.Observacion,
                                                            a.FecRegistro,
                                                            a.UsuRegistro,
                                                            a.FecEdicion,
                                                            a.UsuEdicion,
                                                            a.Venta,
                                                            b.Descripcion as estado, 
                                                            d.Descripcion,
                                                            max(a.FecRegistro) as fecha
                                                            from tbRegistroLlamada as a, tbValorDetalle as b,tbCampañaPersona as c, tbCampaña as d 
                                                            where 
                                                                c.IdCampañaPersona='$ced'
                                                            and  a.IdRespuesta=b.IdValorDetalle 
                                                            and a.IdCampaña=d.IdCampaña
                                                            and c.IdCampañaPersona=a.IdCampañaPersona
                                                            and a.IdCampaña='$idc' 
                                                            group by   c.IdCampañaPersona ,
                                                            c.Campo2 ,
                                                            a.Contacto,
                                                            a.Observacion,
                                                            a.FecRegistro,
                                                            a.UsuRegistro,
                                                            a.FecEdicion,
                                                            a.UsuEdicion,
                                                            a.Venta,
                                                            b.Descripcion, 
                                                            d.Descripcion
                                                            ");

                                                            $agenda = DB::connection('sqlsrv4')->select("SELECT *,DATEDIFF(day,getdate(), fecha) as dias,CONVERT(VARCHAR, hora, 108) horas from DAMPLUSagenda where cedula ='$ced' and campana='$idc'
                                                            ");
                                                            
        return view('Ventas.Clientes.edit',compact('agendar','gestiones','datos','ced','idc','agenda'));
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
        //dd($request);

        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fechaacregisto= $date->format('Y-m-d H:i:s');
        $fechaactualizar = $date->format('Y-m-d');

        $v = \Validator::make($request->all(), [
            
            'telefonoContacto' => 'required|digits_between:9,10|numeric',
            'contacto' => 'required|string',
            'telefonoNuevo' => 'digits_between:9,10|numeric',
            'fecha' => 'required',
            'turno' => 'required',
            'comentario' => 'required|min:20',
        ]);

 


        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
       
        $ActualizarEstado = Damplusagenda::where('id',$id)->update(['estado' => 'R']);///reagendado
        /**
            agregar nuevo agendamiento
        */
        $agenda = new Damplusagenda;
        $agenda->idc                =   $request->IdCampaña.$request->IdCampañaPersona; 
        $agenda->estado             =   'A'; 
        $agenda->users              =   $usuario; 
        $agenda->cedula             =   $request->IdCampañaPersona; 
        $agenda->nombres            =   $request->nombres; 
        $agenda->campanadescripcion =   $request->campanadescripcion; 
        $agenda->campana            =   $request->IdCampaña; 
        $agenda->telefonoContacto   =   $request->telefonoContacto; 
        $agenda->contacto           =   $request->contacto; 
        $agenda->telefonoNuevo      =   $request->telefonoNuevo; 
        $agenda->contactarcel       =   $request->contactarcel; 
        $agenda->codigoArea         =   $request->codigoArea;
        $agenda->convencional       =   $request->convencional; 
        $agenda->contactarconv      =   $request->contactarconv; 
        $agenda->turno              =   $request->turno; 
        $agenda->comentario         =   $request->comentario; 
        $agenda->fecha              =   $request->fecha;
        $agenda->hora               =   $request->hora;
        $agenda->actualizado        =   $fechaactualizar;
        $agenda->save();

        return redirect()->route('agenda.index')
        ->with('info', 'Cliente Reagendado Correctamente..!');
    }

  
    public function reportes()
    {
        $data = Damplusagendadetalle::all();
        $total = $data->count();

        dd($data);

        return   view('Ventas.admin');
    }
}
