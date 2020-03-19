<?php

namespace App\Http\Controllers\Cobranza;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cobranza\Asignacion;
use App\Models\Cobranza\ClientesCobranza;
use App\Models\Cobranza\GestionesCobranza;
use App\Models\Cobranza\DAMPLUStelefonos;
use App\Models\Cobranza\PagosCobranza;
use App\Models\Cobranza\Cuotas;
use App\Models\Cobranza\DetalleCuotas;
use App\Models\Predictivo\Vicidial_log;
use App\Models\Predictivo\Vicidial_list;
use App\Models\Predictivo\Recording_log;
use App\Imports\AsignacionesImport;
use App\Exports\AsignacionRespaldoExport;
use Illuminate\Console\Command;
use Excel;
use DB;
use Auth;
use DateTime;
use App\Collection;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Exports\DAMPLUStelefonosExport;
use App\Exports\DAMPLUStelefonosAgentesExport;
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
    public function index(Request $request)
    {
        $fechaperido = '01-11-2019';
        $user = Auth::user();
        $usuario = $user->usuario;

        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');

        $clientes_agentes = DB::connection('sqlsrv')->select("SELECT cast(IdCampaña as nvarchar(10))+Identificacion as idc FROM tbCampañaPersona where IdAgente='$usuario'");
        
        $clientes[]="";
        foreach ($clientes_agentes as  $clientes_agente) {
        $clientes[] =$clientes_agente->idc;
        }

        $pagos = PagosCobranza::select(DB::raw('CONCAT(tbCampañaPersonaPago.IdCampaña, tbCampañaPersonaPago.Identificacion) as idc'))
                                                ->where('FecRegistro','>=',$fechaperido)
                                                ->whereNull('UsuAnula')
                                                ->whereIn(DB::raw('CONCAT(tbCampañaPersonaPago.IdCampaña, tbCampañaPersonaPago.Identificacion)'),$clientes)
                                                ->get();

        $compromisos = GestionesCobranza::select(DB::raw('CONCAT(tbRegistroLlamada.IdCampaña, tbRegistroLlamada.Identificacion) as idc'))
                                                ->where('IdRespuesta','14')
                                                ->where('FecRegistro','>=',$fechaperido)
                                                ->where('PromesaPago','>=',$fecha)
                                                ->whereIn(DB::raw('CONCAT(tbRegistroLlamada.IdCampaña, tbRegistroLlamada.Identificacion)'),$clientes)
                                                ->get();
                                                
                                                
        $idcp[]="";
        foreach ($pagos as  $pago) {
        $idcp[] =$pago->idc;
        }

        $idcompromisos[]="";
        foreach ($compromisos as  $compromiso) {
        $idcompromisos[] =$compromiso->idc;
        }

      
        $cedula = $request->get('cedulaxge');
        $porgestionar = ClientesCobranza::select(
            'tbCampañaPersona.IdCampaña',
            'tbCampañaPersona.Identificacion',
            'tbCampañaPersona.IdAgente',
            'tbCampañaPersona.Campo9',
            'tbCampañaPersona.Nombres',
            'tbCampañaPersona.ValorDeuda',
            'tbCampañaPersona.SaldoDeuda',
            'tbCampañaPersona.PromesaPago',
            'tbCampañaPersona.PromesaMontoPago',
            'tbCampaña.Descripcion'
            )
        ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
        ->whereNotIn(DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion)'),$idcompromisos)
        ->whereNotIn(DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion)'),$idcp)
        ->Where('IdAgente',$usuario)

        ->cedulaxge($cedula)
        ->orderBy('tbCampañaPersona.Campo9', 'DESC')
        ->paginate(10);

        //dd($compromisos);
        $cedula = $request->get('cedulacmp');
       
        $compromisospendientes = ClientesCobranza::select(
            'tbCampañaPersona.IdCampaña',
            'tbCampañaPersona.Identificacion',
            'tbCampañaPersona.IdAgente',
            'tbCampañaPersona.Campo9',
            'tbCampañaPersona.Nombres',
            'tbCampañaPersona.ValorDeuda',
            'tbCampañaPersona.SaldoDeuda',
            'tbCampañaPersona.PromesaPago',
            'tbCampañaPersona.PromesaMontoPago',
            'tbCampaña.Descripcion'
            )
        ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
        ->whereNotIn(DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion)'),$idcp)
        ->whereIn(DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion)'),$idcompromisos)
        ->Where('IdAgente',$usuario)

        ->cedulacmp($cedula)
        ->orderBy('tbCampañaPersona.Campo9', 'DESC')
        ->paginate(8);


        $cedula = $request->get('cedulapag');
       
        $pagoss = ClientesCobranza::select(
            'tbCampañaPersona.IdCampaña',
            'tbCampañaPersona.Identificacion',
            'tbCampañaPersona.IdAgente',
            'tbCampañaPersona.Campo9',
            'tbCampañaPersona.Nombres',
            'tbCampañaPersona.ValorDeuda',
            'tbCampañaPersona.SaldoDeuda',
            'tbCampañaPersona.PromesaPago',
            'tbCampañaPersona.PromesaMontoPago',
            'tbCampaña.Descripcion'
            )
        ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
        ->whereIn(DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion)'),$idcp)
        ->Where('IdAgente',$usuario)
        ->cedulapag($cedula)
        ->orderBy('tbCampañaPersona.Campo9', 'DESC')
        ->paginate(8);

        $cartera =  DB::connection('sqlsrv')->select(" SELECT  COUNT(Identificacion) as clientes, Campo9 as area
                                                        FROM tbCampañaPersona 
                                                        group by Campo9");         
                                                        
                                                     
        if ($request->ajax()) {
        $data = $clientes_agentes;
        
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }
                                                        


//dd($clientes );
        return view('Cobranza.Clientes.index',compact('cartera','porgestionar','compromisospendientes','pagoss'));
    }

    public function buscadorCobranza(Request $request)
    {
     
        //$clientes = ClientesVentas::where("IdCampañaPersona",'like',$request->texto."%")->take(10)->get();

        $clientes = DB::connection('sqlsrv')->table('tbCampañaPersona')
        ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersona.IdCampaña')
    
        ->select('tbCampañaPersona.Identificacion',
                  'tbCampañaPersona.Nombres',
                  'tbCampañaPersona.TelefonoPrincipal',
                  'tbCampañaPersona.ValorDeuda',
                  'tbCampañaPersona.SaldoDeuda',
                  'tbCampaña.Descripcion',
                  'tbCampañaPersona.IdCampaña',
                  'tbCampañaPersona.IdAgente',
                  'tbCampañaPersona.Campo9'
                  )
        ->where("tbCampañaPersona.Identificacion",'like',$request->texto."%")
        ->take(10)->get();
        return view('Cobranza.Clientes.buscador.paginas', compact('clientes'));
    }

    public function edit($idc,$ced)
    {
        
        $datos = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
        //$datos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersona WHERE cast(IdCampaña as nvarchar(10))+Identificacion ='$id'")->first();
        $areas = DB::connection('sqlsrv')->select("SELECT DISTINCT Campo9 FROM tbCampañaPersona");
        $agentes = DB::connection('sqlsrv')->select("SELECT DISTINCT IdPersona FROM tbPersona");

        $pagos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersonaPago WHERE Identificacion='$ced' AND IdCampaña='$idc' and UsuAnula is null order by FecRegistro desc");
       // dd($datos);
        
        return view('Cobranza.Clientes.edit',compact('datos','areas','agentes','pagos'));

    }


    public function update(Request $request, $idc,$ced)
    {  
        
        

        /**
         * validar que vengan los campos con datos si no conservar el mismo anterior  
         */
        if (is_null($request->Campo92)) {
            $area = $request->Campo9;
          
        }else {
            $area = $request->Campo92;
        }
        
        if (is_null($request->IdPersona2)) {
            $agente = $request->IdAgente;
            
        }else {
            $agente=$request->IdPersona2;
        }
       // dd($agente.' '.$area);

        $agente = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->update(['IdAgente' => $agente]);// actualizar agente
        $area = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->update(['Campo9' => $area]);// actualizar area


        return redirect()->route('clientes.edit', [$idc,$ced])->with('msg', 'Cliente Actualizado !!');
    }

    public function show($idc,$ced)
    {

      
        
        $datos = ClientesCobranza::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
        $areas = DB::connection('sqlsrv')->select("SELECT DISTINCT Campo9 FROM tbCampañaPersona");
        $agentes = DB::connection('sqlsrv')->select("SELECT DISTINCT IdPersona FROM tbPersona");
        $pagos = DB::connection('sqlsrv')->select("SELECT * FROM tbCampañaPersonaPago WHERE Identificacion='$ced' AND IdCampaña='$idc' and UsuAnula is null order by FecRegistro desc");
        $cuotas = Cuotas::where('Identificacion',$ced)->where('IdCampaña',$idc)->first();
       // dd($cuotas);
        
        if (!is_null($cuotas)) {
            $cuotanum = $cuotas->IdCampañaPersonaCuota;
            $detallecuotas = DetalleCuotas::where('IdCampañaPersonaCuota',$cuotanum )->get();
           // DD($cuotanum);
        }else {
            $detallecuotas=0;
        }
        
     
        $direciones = DB::connection('sqlsrv')->select(" SELECT Identificacion,Direccion,Referencia,UsuRegistro,FecRegistro FROM tbCampañaPersonaDireccion WHERE  Identificacion='$ced' AND IdCampaña='$idc' order by FecRegistro desc ");
        $telefonos = DB::connection('sqlsrv')->select(" SELECT distinct TelefonoPersona,NombreReferencia from tbCampañaPersonaTelefono WHERE Identificacion='$ced' AND IdCampaña='$idc' ");
        $telefonoslla = DB::connection('sqlsrv')->select(" SELECT distinct TelefonoPersona from tbRegistroLlamada WHERE Identificacion='$ced' AND IdCampaña='$idc' and IdRespuesta in ('14','24')");
        $parentescos = DB::connection('sqlsrv')->select(" SELECT * from DAMPLUSparentescos WHERE cedula='$ced' order by parentesco desc ");
        //dd($parentescos);
      
        
        
        $gestiones = GestionesCobranza::select(
            'tbRegistroLlamada.Identificacion',
            'tbRegistroLlamada.FecRegistro',
            'tbRegistroLlamada.UsuRegistro',
            'tbRegistroLlamada.Comentario',
            'tbRegistroLlamada.PromesaMontoPago',
            'tbRegistroLlamada.PromesaPago',
            'tbValorDetalle.Descripcion',
            'tbRegistroLlamada.TelefonoPersona'
            )
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbRegistroLlamada.IdRespuesta')
        ->where('IdCampaña',$idc)
        ->where('Identificacion',$ced)
        ->whereIn('IdRespuesta',['14','24'])
        ->orderBy('FecRegistro', 'DESC')
        ->paginate(10);

        
        $telefonopre[] ='0999999999';

        foreach ($telefonoslla as  $telefono) {
            $telefonopre[] = $telefono->TelefonoPersona;
        }
        

        $gestionesPRE = Vicidial_log::select(
                                                'vicidial_log.USER                  AS asesor',
                                                'vicidial_log.user_group            AS grupo',
                                                'vicidial_log.call_date             AS fecha',
                                                'vicidial_list.first_name           AS cedula',
                                                'vicidial_log.phone_number          AS telefono',
                                                'vicidial_list.alt_phone            AS telefono_adicional',
                                                'vicidial_list.security_phrase      AS telefono_parentesco',
                                                'vicidial_list.middle_initial       AS nombre_parentesco',
                                                'vicidial_list.gender               AS confirmacion',
                                                'vicidial_list.comments             AS negociacion',
                                                'vicidial_list.state                AS contacto',
                                                'vicidial_log.status              AS estado',
                                                'vicidial_log.campaign_id           AS campana',
                                                'vicidial_log.list_id',
                                                'vicidial_log.lead_id',
                                                'vicidial_log.uniqueid',
                                                'vicidial_list.title',
                                                'recording_log.location'
                                            )
                                            ->join('vicidial_list', 'vicidial_list.lead_id', '=', 'vicidial_log.lead_id')
                                            ->join('recording_log', 'recording_log.vicidial_id', '=', 'vicidial_log.uniqueid')
                                            ->whereIn('vicidial_log.status',['CMP','CMPT'])
                                            ->whereIn('vicidial_log.phone_number',$telefonopre)
                                            ->orderBy('vicidial_log.call_date', 'DESC')
                                            ->paginate(10);
      $idcc = $idc.$ced;
   
 
                                            $DAMPLUStelefonos = DAMPLUStelefonos::where('idc',$idcc)->first();
       // dd($DAMPLUStelefonos);

        
        return view('Cobranza.Clientes.show',compact('datos','areas','agentes','pagos','gestiones','direciones','telefonos','cuotas','detallecuotas','gestionesPRE','DAMPLUStelefonos','idcc','parentescos'));

    }


    
    public function cartera($cartera)
    {
        $datos = ClientesCobranza::where('Campo9',$cartera)->first();
        //dd(  $datos );
        return view('Cobranza.Clientes.cartera',compact('datos','areas','agentes','pagos'));

    }



    public function DAMPLUStelefonos(Request $request,$idc)
    
    {
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y H:m:s');
        $v = \Validator::make($request->all(), [
            
            'telefono1' => 'digits_between:10,10|numeric',
            'telefono2' => 'digits_between:10,10|numeric',
            'email' => 'email',
        ]);
       
       // dd(  $request );
        $telefono1 = DAMPLUStelefonos::where('idc',$idc)->update(['telefono1' => $request->input('telefono1')]);
        $telefono2 = DAMPLUStelefonos::where('idc',$idc)->update(['telefono2' => $request->input('telefono2')]);
        $telefono3 = DAMPLUStelefonos::where('idc',$idc)->update(['telefono3' => $request->input('telefono3')]);
        $telefono4 = DAMPLUStelefonos::where('idc',$idc)->update(['telefono4' => $request->input('telefono4')]);
        $convencional = DAMPLUStelefonos::where('idc',$idc)->update(['convencional' => $request->input('convencional')]);
        $extension  = DAMPLUStelefonos::where('idc',$idc)->update(['extension' => $request->input('extension')]);
        $convencionaltrabajo  = DAMPLUStelefonos::where('idc',$idc)->update(['convencionaltrabajo' => $request->input('convencionaltrabajo')]);
        $direccioncasa  = DAMPLUStelefonos::where('idc',$idc)->update(['direccioncasa' => $request->input('direccioncasa')]);
        $direcciontrabajo  = DAMPLUStelefonos::where('idc',$idc)->update(['direcciontrabajo' => $request->input('direcciontrabajo')]);
        $extension  = DAMPLUStelefonos::where('idc',$idc)->update(['extension' => $request->input('extension')]);
        $email = DAMPLUStelefonos::where('idc',$idc)->update(['email' => $request->input('email')]);
        $telefonoparentesco = DAMPLUStelefonos::where('idc',$idc)->update(['telefonoparentesco' => $request->input('telefonoparentesco')]);
        $parentesco1 = DAMPLUStelefonos::where('idc',$idc)->update(['parentesco1' => $request->input('parentesco1')]);
        $estadolab = DAMPLUStelefonos::where('idc',$idc)->update(['estadolab' => $request->input('estadolab')]);
        $observacion = DAMPLUStelefonos::where('idc',$idc)->update(['observacion' => $request->input('observacion')]);
        $usersedit = DAMPLUStelefonos::where('idc',$idc)->update(['usersedit' => $usuario]); 

        $observacion = DAMPLUStelefonos::where('idc',$idc)->update(['contesta' => $request->input('contesta')]);
        $observacion = DAMPLUStelefonos::where('idc',$idc)->update(['estadoclientes' => $request->input('estadoclientes')]);
        $observacion = DAMPLUStelefonos::where('idc',$idc)->update(['pagar' => $request->input('pagar')]);
        $observacion = DAMPLUStelefonos::where('idc',$idc)->update(['observacionestadocliente' => $request->input('observacionestadocliente')]);
        $fecha = DAMPLUStelefonos::where('idc',$idc)->update(['updated_at' => $fecha]);
        return back()->with('info', ' Actualizado Correctamente..!');
       
       

    }

    public function agregar(Request $request)
    {
      
        $user = Auth::user();
        $usuario = $user->usuario;
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y H:m:s');
        //dd($fecha);
        
        $DAMPLUStelefonos = new DAMPLUStelefonos;
        $DAMPLUStelefonos->idc                =   $request->idc; 
        $DAMPLUStelefonos->telefono1          =   $request->telefono1; 
        $DAMPLUStelefonos->telefono2          =   $request->telefono2; 
        $DAMPLUStelefonos->telefono3          =   $request->telefono3;  
        $DAMPLUStelefonos->telefono4          =   $request->telefono4;   
        $DAMPLUStelefonos->email              =   $request->email;  
        $DAMPLUStelefonos->convencional       =   $request->convencional;  
        $DAMPLUStelefonos->convencionaltrabajo=   $request->convencionaltrabajo; 
        $DAMPLUStelefonos->direccioncasa      =   $request->direccioncasa;   
        $DAMPLUStelefonos->direcciontrabajo   =   $request->direcciontrabajo;  
        $DAMPLUStelefonos->extension          =   $request->extension; 
        $DAMPLUStelefonos->telefonoparentesco =   $request->telefonoparentesco; 
        $DAMPLUStelefonos->parentesco1        =   $request->parentesco1; 
        $DAMPLUStelefonos->estadolab          =   $request->estadolab; 
        $DAMPLUStelefonos->observacion        =   $request->observacion; 
        $DAMPLUStelefonos->users              =   $usuario; 
        $DAMPLUStelefonos->contesta           =   $request->contesta; 
        $DAMPLUStelefonos->estadoclientes     =   $request->estadoclientes; 
        $DAMPLUStelefonos->pagar               =  $request->pagar;
        $DAMPLUStelefonos->observacionestadocliente =  $request->observacionestadocliente;
        $DAMPLUStelefonos->created_at              =   $fecha; 
      
        $DAMPLUStelefonos->save();

        return back()->with('info', ' Contactos Agregados  Correctamente..!');
       
    }



    public function contactos()
    {
        $clientes = DAMPLUStelefonos::get();

        $agentes = DB::connection('sqlsrv')->select("SELECT COUNT(idc) as cant,users FROM DAMPLUStelefonos group by users order by cant desc ");
        

        return view('Cobranza.Clientes.contactos',compact('clientes','agentes'));
    }

    
    public function exportartodo(Request $request)
    {
       
        
        $date = new DateTime(); 
        $d= $date->format('Y-m-d H:i:s');
        
        return (new DAMPLUStelefonosExport)->download($d .'contactos.xls');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportaragente($idagente)
    {
        
        
        $date = new DateTime(); 
        $d= $date->format('Y-m-d H:i:s');
        
        return (new DAMPLUStelefonosAgentesExport($idagente))->download($idagente.'_'.$d .'contactos.xls');
     

    
    }

    public function imagenes()
    {

        return view('clientes.imagenes');
    }




    public function subir(Request $request)
    {

        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
        $ano    = $date->format('Y');
        $mes    = $date->format('m');
        $dia    = $date->format('d');

        dd($fecha);
        
        $request->file('archivo')->store('recibos/01');


        dd("subido y guardado");
        return redirect('imagenes')->with('status', "Image uploaded successfully.");
    
    }

    public function imprimir($idp){
         $pagos = PagosCobranza::where('IdCampañaPersonaPago',$idp)->first();

        $idc = $pagos->IdCampaña.$pagos->Identificacion;
  


        $datos = PagosCobranza::select(

            'tbCampañaPersonaPago.IdCampañaPersonaPago                  AS recibo',
            'tbCampañaPersonaPago.FecRegistro                           AS fecha',
            'tbCampañaPersonaPago.Identificacion                        AS cedula',
            'tbCampañaPersonaPago.SaldoAntesPago',
            'tbCampañaPersonaPago.Valor',
            'tbCampañaPersonaPago.SaldoActual',
            'tbCampañaPersonaPago.UsuConfirmacion',
            'tbCampañaPersonaPago.NotasCaja',
            'tbCampañaPersonaPagoDetalle.NumeroDocumento',
            'tbPersona.Nombre as empresa',
            'tbCampañaPersona.Nombres',
            'tbCampañaPersona.TelefonoPrincipal',
            'tbCampañaPersona.Campo3',
            'tbCampañaPersona.IdAgente as Agente',
            'tbCampaña.Descripcion as campana',
            'tbValorDetalle.Descripcion as tipoTransferencia'
            
        )
        ->join('tbCampañaPersonaPagoDetalle', 'tbCampañaPersonaPagoDetalle.IdCampañaPersonaPago', '=', 'tbCampañaPersonaPago.IdCampañaPersonaPago')
        ->join('tbCampañaPersona', DB::raw('CONCAT(tbCampañaPersona.IdCampaña, tbCampañaPersona.Identificacion) '), '=', DB::raw('CONCAT(tbCampañaPersonaPago.IdCampaña, tbCampañaPersonaPago.Identificacion)'))
        ->join('tbCampaña', 'tbCampaña.IdCampaña', '=', 'tbCampañaPersonaPago.IdCampaña')
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbCampañaPersonaPagoDetalle.IdFormaPago')
        ->join('tbPersona', 'tbPersona.IdPersona', '=', 'tbCampaña.IdPersonaCliente')
        ->where('tbValorDetalle.IdValor','71')
        ->where('tbCampañaPersonaPago.IdCampañaPersonaPago',$idp)
        ->first();


        $origen = PagosCobranza::select(

            'tbCampañaPersonaPago.IdCampañaPersonaPago AS recibo',
            'tbValorDetalle.Descripcion'
            
        )
        ->join('tbCampañaPersonaPagoDetalle', 'tbCampañaPersonaPagoDetalle.IdCampañaPersonaPago', '=', 'tbCampañaPersonaPago.IdCampañaPersonaPago')
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbCampañaPersonaPagoDetalle.IdBancoOrigen')
        ->where('tbValorDetalle.IdValor','70')
        ->where('tbCampañaPersonaPago.IdCampañaPersonaPago',$idp)
        ->first();

        $destino = PagosCobranza::select(

            'tbCampañaPersonaPago.IdCampañaPersonaPago AS recibo',
            'tbValorDetalle.Descripcion'
            
        )
        ->join('tbCampañaPersonaPagoDetalle', 'tbCampañaPersonaPagoDetalle.IdCampañaPersonaPago', '=', 'tbCampañaPersonaPago.IdCampañaPersonaPago')
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbCampañaPersonaPagoDetalle.IdBancoDestino')
        ->where('tbValorDetalle.IdValor','77')
        ->where('tbCampañaPersonaPago.IdCampañaPersonaPago',$idp)
        ->first();

       

        $tarjeta = PagosCobranza::select(

            'tbCampañaPersonaPago.IdCampañaPersonaPago AS recibo',
            'tbValorDetalle.Descripcion'
            
        )
      
        ->join('tbCampañaPersonaPagoDetalle', 'tbCampañaPersonaPagoDetalle.IdCampañaPersonaPago', '=', 'tbCampañaPersonaPago.IdCampañaPersonaPago')
        ->join('tbValorDetalle', 'tbValorDetalle.IdValorDetalle', '=', 'tbCampañaPersonaPagoDetalle.IdTarjeta')
        ->where('tbValorDetalle.IdValor','65')
        ->where('tbCampañaPersonaPago.IdCampañaPersonaPago',$idp)
        ->first();

        $tipocampana = $datos->campana;
        $cedula = $datos->cedula;
        $Nombres = $datos->Nombres;
        $recibo = $datos->recibo;
        $fecha = $datos->fecha;
        $MEDINA = strpos($tipocampana , 'MEDINA');
        $DAVILA = strpos($tipocampana , 'DAVILA');
        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
      
        $pdf = \PDF::loadView('Cobranza.Pdf.recibo',compact('datos','origen','destino','tarjeta','MEDINA','DAVILA'));
        //return $pdf->download('recibo.pdf');
        return $pdf->download("recibo $recibo $cedula $Nombres $fecha.pdf");
    }
    

}