<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        
        <link rel="stylesheet" href="{{ asset('css/otropdf.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pdfbootstrap.css') }}">
      
    <style>
            body { font-family: "Arial" }
            h1{
            text-align: center;
            text-transform: uppercase;
            }
            .contenido{
            font-size: 20px;
            font-family: Arial, Helvetica, Sans-serif
            }
            #primero{
            background-color: #ccc;
            }
            #segundo{
            color:#44a359;
            }
            #tercero{
            text-decoration:line-through;
            }
                
            #cudro {
            border: grey 1px solid;
            font-family: "Arial"
            color: black;
            padding: 20px;
            }
            #logo {
                padding: 5px;
            }
            

        </style>
    </head>
    <body>
        <table class="table" >
           <td align="center">
                <img src="{{ asset('logo_medina.png') }}" width="270" height="100"/> 
                <p >
                        Guayaquil: Tungurahua 519 y 9 de Octubre <br>
                        Edificio Santa Martha piso 8 <br> Teléfono: (04) 5001822 ext. 119 <br> RUC: 0992900156001
                </p>
            </td>
            
                <td  colspan="3">     
                    <strong>Recibo de Pago: </strong>  
                        # {{ $datos->recibo }}
                    <br>
                     <strong>Fecha de Pago:</strong>         
                        {{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}
                        <br>
                     <strong> Documento:</strong> &nbsp;      
                        {{ $datos->NumeroDocumento }}    
                        <br>
                     <strong> Forma de Pago:</strong> &nbsp; 
                        {{ $datos->tipoTransferencia }}     
                        <br>
                     <strong> Empresa:</strong> &nbsp; 
                        {{ $datos->empresa }}   
                        <br>
                     <strong> Banco de Origen:</strong>  
                        {{ $origen->Descripcion }}   
                        <br>
                     <strong> Banco de Destino:</strong> 
                        {{ $destino->Descripcion }}   
                    
                </td>
        </table>

        <table id="cudro" align="center" >
            <tr >
                <th align="center">Nombres: &nbsp; {{ $datos->Nombres }}</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th align="center">Cedula: &nbsp;{{ $datos->cedula }}</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            <tr>
                <th align="right">Direccion: &nbsp; {{ $datos->Nombres }}</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th align="right">Telefono: &nbsp;{{ $datos->cedula }}</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            
        </table>
        <br>
      
                <table class="table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Saldo Anterior </td>
                            <td>Abono</td>
                            <td>Saldo Actual</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <th>{{ $datos->recibo }}</th>
                            <th>{{ $datos->SaldoAntesPago }}</th>
                            <th>{{ $datos->Valor }}</th>
                            <th>{{ $datos->SaldoActual }}</th>
                        </tr>
                    </tbody>
                </table>

                <div class="container">
                   <table align="center">
                       <tr>
                           <th align="center">______________________________</th>
                           <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                           <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                           <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                           <th align="center">______________________________</th>
                       </tr>
                       <tr>
                           <td align="center">Firma / Cliente</td>
                           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                           <td align="center">Firma Autorizada</td>
                       </tr>
                   </table>
                </div>
          <!-- Latest compiled and minified JavaScript -->
          <table border="1" >
            <caption>Leyenda</caption>
            <colgroup><col><col></colgroup>
            <colgroup><col></colgroup>
            <tbody>
              <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
              </tr>
            </tbody>
          </table>

<br>
<br>
<br>
<br>
-------------------------------------------------------------------------------------------------------------------------------------------------------
<br>
<br>
<br>
<br>
 

          <table class="table">
            <td align="center">
                 <img src="{{ asset('logo_medina.png') }}" width="270" height="100"/> <br>
                 <small >
                         Guayaquil: Tungurahua 519 y 9 de Octubre Edificio Santa Martha piso 8 <br> Teléfono: (04) 5001822 ext. 119 <br> RUC: 0992900156001
                 </small>
             </td>
             <td>&nbsp;&nbsp;</td>
                 <td id="cudro" colspan="2">     
                     <p> <strong>Recibo de Pago: </strong>  
                         # {{ $datos->recibo }}
                     </p>
                     <p> <strong>Fecha de Pago:</strong>         
                         {{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}
                     </p>
                     <p> <strong> Documento:</strong> &nbsp;      
                         {{ $datos->NumeroDocumento }}    
                     </p>
                     <p> <strong> Forma de Pago:</strong> &nbsp; 
                         {{ $datos->tipoTransferencia }}     
                     </p>
                     <p> <strong> Empresa:</strong> &nbsp; 
                         {{ $datos->empresa }}   
                     </p>
                 </td>
         </table>
         <table class="table">
             <td id="cudro2" colspan="3">
                 <strong> Cedula: </strong> {{ $datos->cedula }}<br> 
                 <strong> Nombres: </strong> {{ $datos->Nombres }} <br>
                 <strong> Telefono: </strong> {{ $datos->cedula }} <br>
                 <strong> Direccion: </strong> {{ $datos->Nombres }}
             </td>
                 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                 <td colspan="3">  <small> <strong>Banco de Origen </strong> <br>{{ $origen->Descripcion }}  </small></td> 
                 <td colspan="3">  <small> <strong>Banco de Destino </strong> <br>{{ $destino->Descripcion }}   </small></td>
         </table>
        
                 <table class="table">
                     <thead>
                         <tr>
                             <td>ID</td>
                             <td>Saldo Anterior </td>
                             <td>Abono</td>
                             <td>Saldo Actual</td>
                         </tr>
                     </thead>
                     <tbody>
                         <tr >
                             <th>{{ $datos->recibo }}</th>
                             <th>{{ $datos->SaldoAntesPago }}</th>
                             <th>{{ $datos->Valor }}</th>
                             <th>{{ $datos->SaldoActual }}</th>
                         </tr>
                     </tbody>
                 </table>
 
                 <div class="container">
                    <table align="center">
                        <tr>
                            <th align="center">______________________________</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th align="center">______________________________</th>
                        </tr>
                        <tr>
                            <td align="center">Firma / Cliente</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td align="center">Firma Autorizada</td>
                        </tr>
                    </table>
                 </div>
           <!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>