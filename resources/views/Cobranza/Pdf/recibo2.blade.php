<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        
        <link rel="stylesheet" href="{{ asset('css/otropdf.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pdfbootstrap.css') }}">
        <style>
            body { font-family: "Arial" }
            #todos      {
            margin: 10px;
            padding: 30px;
            border-width: 30px;
            
            }
            #cudro {
            border: grey 1px solid;
            font-family: "Arial"
            color: black;
            padding: 20px;
            }
            body { margin: 0; padding: 0; } #box { margin: 0; padding: 0; width: 803px; height: 1400px; border: 1px solid #000; } 

        </style>
    
    </head>
    <body >
       
        <div class="container-fluid" id="todos">
            <div class="row">
                <div class="row">
                    <div class="col-xs-6" align="center">
                        <img src="{{ asset('logo_medina.png') }}" width="250" height="80"/><br>
                        <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                            Edificio Santa Martha piso 8  Teléfono: (04) 5001822 ext. 119  RUC: 0992900156001 </b> 
                        </h6>
                     </div>
                    <div class="col-6 ">
                        <table align="right">
                            <thead>
                                <tr>
                                    <th>Recibo de Pago: </th>
                                    <td># {{ $datos->recibo }}</td>
                                </tr>
                                <tr>
                                    <th> Empresa: </th>
                                    <td> {{ $datos->empresa }}  </td>
                                </tr>
                                <tr>
                                    <th> Forma de Pago: </th>
                                    <td>{{ $datos->tipoTransferencia }} </td>
                                </tr>
                                <tr>
                                    <th> Documento: </th>
                                    <td>{{ $datos->NumeroDocumento }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Pago: </th>
                                    <td>{{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}</td>
                                </tr>
                                
                                <tr>
                                    <th> Banco de Origen: </th>
                                    <td>  {{ $origen->Descripcion }}  </td>
                                </tr>
                                <tr>
                                    <th>  Banco de Destino: </th>
                                    <td>  {{ $destino->Descripcion }}    </td>
                                </tr>
                               
                            </thead>
                        </table>
                    </div>
                </div>
                <br>
                  <div class="row">
                    
                    <div class="col-10 " id="cudro" >
                        <table >
                            <thead>
                                <tr>
                                    <th>Nombres: </th>
                                    <td>{{ $datos->Nombres }}</td>
                                    
                                    <td> &nbsp;  &nbsp; &nbsp;</td>
                                    <th>Cedula: </th>
                                    <td>{{ $datos->cedula }}</td>
                                </tr>
                                <tr >
                                    <th>Direccion: </th>
                                    <td align="right"> {{ $datos->DireccionPrincipal }}</td>
                                    <td> &nbsp;  &nbsp; &nbsp;</td>
                                    <th  >Telefono: </th>
                                    <td>{{ $datos->TelefonoPrincipal }}</td>
                                </tr>
                                
                            </thead>
                        </table>


                    </div>
                  </div>
                <br>

                  <div class="row">
                    <div class="col-12">

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
                    </div>
                   
                  </div>
                <br>
                  <div class="row">
                    <div class="col-12">
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
                   
                  </div>
            </div>
          </div>


<p>------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
          <div class="container-fluid" id="todos">
            <div class="row">
                <div class="row">
                    <div class="col-xs-6" align="center">
                        <img src="{{ asset('logo_medina.png') }}" width="250" height="80"/><br>
                        <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                            Edificio Santa Martha piso 8  Teléfono: (04) 5001822 ext. 119  RUC: 0992900156001 </b> 
                        </h6>
                     </div>
                    <div class="col-6 ">
                        <table align="right">
                            <thead>
                                <tr>
                                    <th>Recibo de Pago: </th>
                                    <td># {{ $datos->recibo }}</td>
                                </tr>
                                <tr>
                                    <th> Empresa: </th>
                                    <td> {{ $datos->empresa }}  </td>
                                </tr>
                                <tr>
                                    <th> Forma de Pago: </th>
                                    <td>{{ $datos->tipoTransferencia }} </td>
                                </tr>
                                <tr>
                                    <th> Documento: </th>
                                    <td>{{ $datos->NumeroDocumento }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Pago: </th>
                                    <td>{{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}</td>
                                </tr>
                                
                                <tr>
                                    <th> Banco de Origen: </th>
                                    <td>  {{ $origen->Descripcion }}  </td>
                                </tr>
                                <tr>
                                    <th>  Banco de Destino: </th>
                                    <td>  {{ $destino->Descripcion }}    </td>
                                </tr>
                               
                            </thead>
                        </table>
                    </div>
                </div>
                <br>
                  <div class="row">
                    
                    <div class="col-10 " id="cudro" >
                        <table >
                            <thead>
                                <tr>
                                    <th>Nombres: </th>
                                    <td>{{ $datos->Nombres }}</td>
                                    
                                    <td> &nbsp;  &nbsp; &nbsp;</td>
                                    <th>Cedula: </th>
                                    <td>{{ $datos->cedula }}</td>
                                </tr>
                                <tr >
                                    <th>Direccion: </th>
                                    <td align="right"> {{ $datos->DireccionPrincipal }}</td>
                                    <td> &nbsp;  &nbsp; &nbsp;</td>
                                    <th  >Telefono: </th>
                                    <td>{{ $datos->TelefonoPrincipal }}</td>
                                </tr>
                                
                            </thead>
                        </table>


                    </div>
                  </div>
                <br>

                  <div class="row">
                    <div class="col-12">

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
                    </div>
                   
                  </div>
                <br>
                  <div class="row">
                    <div class="col-12">
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
                   
                  </div>
            </div>
          </div>

   </body>
</html>