<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Recibo Cliente</title>
        <link href="{{ asset('css/bootstrap.min.css') }}"  rel="stylesheet"  >
       <style>
            body { font-family: "Arial" }
            #todos      {
            margin: 10px;
            padding: 20px;
            border-width: 20px;
            
            }
            span { font-size: 11px; }
        </style>
    
    </head>
    <body >
       
        <div class="container-fluid" id="todos">
            

                <div class="row">
                    <div class="col-xs-5" align="center">
                        @if (!empty($MEDINA))
                            <img src="{{ asset('logo_medina.png') }}" width="200" height="70"/><br>
                            <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                                Edificio Santa Martha piso 8  Teléfono: (04) 5001822 ext. 119  RUC: 0992900156001 </b> 
                            </h6>
                        @else
                            <img src="{{ asset('logo_davila.png') }}" width="200" height="70"/><br>
                            <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                                Edificio Santa Martha piso 10  Teléfono: (04) 5001821 ext. 201  RUC: 0993146838001 </b> 
                            </h6>
                        @endif
                     </div>
                     <div class="col-xs-1" align="center">
                     </div>
                    <div class="col-6 ">
                        <table align="right">
                                <tr>
                                    <th>Nombres.: </th>
                                    <td > <span>{{ $datos->Nombres }}</span></td>
                                </tr>
                                <tr>
                                    <th> Cedula.: </th>
                                    <td><span>{{ $datos->cedula }}</span>  </td>
                                </tr>
                                <tr>
                                    <th> Direccion.: </th>
                                    <td> <span>{{ str_limit($datos->Campo3,30) }}</span> </td>
                                </tr>
                               
                                <tr>
                                    <th>Telefono.: </th>
                                    <td><span>{{ $datos->TelefonoPrincipal }}</span></span></td>
                                </tr>
                        </table>
                    </div>
                </div>
               
                  <div class="row">
                    <div class="col-xs-5">
                        <h5 > <strong> DATOS DE PAGO</strong></h5>
                        <table >
                            <tr>
                                <th>Recibo N°.: </th>
                                <td><b><span> {{ $datos->recibo }}</span><b></td>
                            </tr>
                            <tr>
                                <th> Empresa.: </th>
                                <td><span> {{ $datos->empresa }}  </span></td>
                            </tr>
                            <tr>
                                <th> Forma de Pago.: </th>
                                <td><span>{{ $datos->tipoTransferencia }} </span></td>
                            </tr>
                            <tr>
                                <th>Fecha de Pago.: </th>
                                <td><span>{{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-1">
                    </div>
                    <div class="col-xs-5">
                        <h5> <strong> ESTADO DE CUENTA</strong></h5>
                        <table>
                            <tr>
                                <th>Saldo Anterior.: </th>
                                <td><span>$  {{ number_format($datos->SaldoAntesPago, 2, ',', '.') }}</span></td>
                            </tr>
                            <tr>
                                <th> Abono.: </th>
                                <td><span>$ {{ number_format($datos->Valor, 2, ',', '.') }} </span></td>
                            </tr>
                            <tr>
                                <th>Saldo Actual.: </th>
                                @if ($datos->SaldoActual <= 0)
                                    <td><span>$ 0,00 </span></td>
                                @else
                                    <td><span>$ {{ number_format($datos->SaldoActual, 2, ',', '.') }}</span></td>
                                @endif
                            </tr>
                            <tr>
                                <th>Observación: </th>
                                @if (!empty($datos->NotasCaja))
                                @php
                                    $nota = strtolower($datos->NotasCaja);
                                @endphp
                                <td><span>{{ str_limit($nota ,35) }}</span></td>
                                @else
                                <td><span></span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
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
                                <td align="center"><span>Firma / Cliente</span></td>
                                <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                <td align="center"><span>Firma Autorizada</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <br>
                @if (!empty($MEDINA))
                    <h6><b> <i><small>Cuentas Bancarias a Depositar.:</small></i></b> 
                    <img src="{{ asset('pichincha.png') }}" width="30" height="15"/>&nbsp;&nbsp;<small><b>Corriente N°-</b> 2100128250</small>&nbsp;/&nbsp;<small><b> Ahorro N°-</b>2204797934</small><br> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img  src="{{ asset('Bolivariano.png') }}" width="30" height="15"/>&nbsp;&nbsp;<small><b>Ahorro  N°-</b> 0921420790</small>&nbsp;&nbsp;
                    <img src="{{ asset('produbanco.jpg') }}" width="30" height="15"/>&nbsp;&nbsp;<small><b>Corriente N°-</b> 02006136350</small> </h6>

                
                @else
                    <h6><b> <i><small>Cuentas Bancarias a Depositar.:</small></i></b> 
                    <img src="{{ asset('pichincha.png') }}" width="30" height="15"/>&nbsp;&nbsp;<small><b>Corriente N°-</b> 2100190735</small><br> <br>
                    
                @endif
           
        </div>
        <p>------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
        <br><br>
        <div class="container-fluid" id="todos">
            
            <div class="row">
                <div class="col-xs-5" align="center">
                    @if (!empty($MEDINA))
                        <img src="{{ asset('logo_medina.png') }}" width="200" height="70"/><br>
                        <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                            Edificio Santa Martha piso 8  Teléfono: (04) 5001822 ext. 119  RUC: 0992900156001 </b> 
                        </h6>
                    @else
                        <img src="{{ asset('logo_davila.png') }}" width="200" height="70"/><br>
                        <h6 align="center"> <b> Guayaquil: Tungurahua 519 y 9 de Octubre 
                            Edificio Santa Martha piso 10  Teléfono: (04) 5001821 ext. 201  RUC: 0993146838001 </b> 
                        </h6>
                    @endif
                </div>
                <div class="col-xs-1" align="center">
                </div>
                <div class="col-6 ">
                    <table align="right">
                        <tr>
                            <th>Nombres.: </th>
                            <td><span><span>{{ $datos->Nombres }}</span></span></td>
                        </tr>
                        <tr>
                            <th> Cedula.: </th>
                            <td><span><span> {{ $datos->cedula }}  </span></span></td>
                        </tr>
                        <tr>
                            <th> Direccion.: </th>
                            <td><span><span>{{ str_limit($datos->Campo3,30) }} </span></span></td>
                        </tr>
                    
                        <tr>
                            <th>Telefono.: </th>
                            <td><span><span>{{ $datos->TelefonoPrincipal }}</span></span></td>
                        </tr>
                    </table>
                </div>
            </div>
    
            <div class="row">
                <div class="col-xs-5">
                    <h5 > <strong> DATOS DE PAGO</strong></h5>
                    <table >
                        <tr>
                            <th>Recibo N°.: </th>
                            <td><b><span> {{ $datos->recibo }}</span></b></td>
                        </tr>
                        <tr>
                            <th> Documento: </th>
                            <td><span>{{ $datos->NumeroDocumento }}</span></td>
                        </tr>
                        <tr>
                            <th> Empresa.: </th>
                            <td><span> {{ $datos->empresa }}  </span></td>
                        </tr>
                        <tr>
                            <th> Forma de Pago.: </th>
                            <td><span>{{ $datos->tipoTransferencia }} </span></td>
                        </tr>
                    
                        <tr>
                            <th>Fecha de Pago.: </th>
                            <td><span>{{ Carbon\Carbon::parse($datos->fecha)->format('d-m-Y ') }}</span></td>
                        </tr>
                        <tr>
                            <th> Banco de Origen: </th>
                            @if (!empty($origen->Descripcion))
                            <td><span>  {{ $origen->Descripcion }}  </span></td>
                            @else
                            <td><span></span></td>
                            @endif
                        </tr>
                        <tr>
                            <th>  Banco de Destino: </th>
                            @if (!empty($destino->Descripcion))
                            <td><span>  {{ $destino->Descripcion }}    </span></td>
                            @else
                            <td><span>{{ $datos->SaldoActual }} </span></td>
                            @endif
                        </tr>
                    </table>
                </div>

                <div class="col-xs-1">
                </div>

                <div class="col-xs-5">
                    <h5> <strong> ESTADO DE CUENTA</strong></h5>
                    <table>
                        <tr>
                            <th>Saldo Anterior.: </th>
                            <td><span>$  {{ number_format($datos->SaldoAntesPago, 2, ',', '.') }}</span></td>
                        </tr>
                        <tr>
                            <th> Abono.: </th>
                            <td><span>$ {{ number_format($datos->Valor, 2, ',', '.') }} </span></td>
                        </tr>
                        <tr>
                            
                            <th>Saldo Actual.: </th>
                            @if ($datos->SaldoActual <= 0)
                            <td><span>$ 0,00 </span></td>
                            @else
                            <td><span>$ {{ number_format($datos->SaldoActual, 2, ',', '.') }}</span></td>
                            @endif
                        </tr>
                    
                        <tr>
                            <th>Observación: </th>
                            @if (!empty($datos->NotasCaja))
                            @php
                                $nota = strtolower($datos->NotasCaja);
                            @endphp
                            <td><span>{{ str_limit($nota ,50) }}</span></td>
                            @else
                            <td><span></span></td>
                            @endif
                        </tr>
                    </table>
                
                    <br>
                    <table>
                        <tr>
                            <th>Asesor.: </th>
                            <td><span>{{ $datos->Agente }}</span></td>
                        </tr>
                        <tr>
                            <th> Caja.: </th>
                            <td><span> {{ $datos->UsuConfirmacion }}  </span></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
            <br>
            <br>
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
                            <td align="center"> <span>Firma / Cliente</span></td>
                            <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                            <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                            <td><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                            <td align="center"> <span>Firma Autorizada</span></td>
                        </tr>
                    </table>
                
                </div>
            </div>

        </div>
            
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>
    </body>
</html>