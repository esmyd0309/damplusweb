<template>
    <div class="containe">
        <div class="card">
            <div class="card-header" v-for="(item, index) in cliente" :key="index">
                <div class="row">
                    <div class="col-lg-3">
                        <span><strong>Deuda:</strong> {{ item.valordeuda }} </span>
                    </div>  
                    <div class="col-lg-3">
                        <span><strong>Saldo:</strong> {{ item.saldodeuda }} </span>
                    </div> 
                </div>
            </div>

            <div class="card-body">
                <template v-if="errorMostrarMsgPago.length > 0">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" @click="resetError()" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                        <ul>
                            <li v-for="error in errorMostrarMsgPago" :key="error" v-text="error"></li>
                        </ul>
                    </div>
                </template>
        
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="abono">Abono ($)</label>
                            <input type="text" class="form-control" @keyup="validarAbonoNumerico()" v-model="abono" required="required" placeholder="Ingrese el abono">
                        </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                            <label for="interes">Interés (%)</label>
                            <input type="text" class="form-control" @keyup="validarInteresNumerico()" v-model="interes" required="required" placeholder="Ingrese el Interés">
                        </div>
                    </div>
                    <div class="col">                    
                        <div class="form-group">
                            <label for="periodo">Cuota a pagar $</label>
                            <input type="text" class="form-control" @keyup="validarCuotaNumerico()" v-model="cuota" required="required" placeholder="Ingrese la cuota a pagar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"> 
                        <div class="form-group">
                            <label for="fecha_pago">Fecha Pagar</label>
                            <b-form-datepicker v-model="fecha_pago" :min="min" :max="max" locale="en"></b-form-datepicker>
                        </div>
                    </div>
                </div>
                <template v-if="calcularPeriodo != null && calcularPeriodo > 0">
                    <div class="form-group" v-if="cuota">
                          <b-alert show variant="primary"><a class="alert-link"> <center> Pago realizados a un plazo de {{ calcularPeriodo }} mes(es)</center></a></b-alert>
                    </div>
                </template>
                <div class="card-footer">
                    <button type="button" @click="calculate" class="btn btn-sm btn-primary" v-if="fecha_pago"><i class="fas fa-cogs"></i> Calcular</button>
                    <button type="button" @click="reset" class="btn btn-sm btn-warning" v-if="amortizar == true"><i class="fas fa-broom"></i> Limpiar</button>
                    <button type="button" @click="postPago" class="btn btn-sm btn-success" v-if="amortizar == true"><i class="far fa-check-circle"></i> Establecer</button>
                </div>
                       
                <br>
                <template v-if="amortizar == true">
                    
                    <div class="row"  v-if="amortizar == true">
                            
                        <div class="table-responsive">
                            <b-alert show variant="secondary"><center><i class="fas fa-chart-pie"></i> <strong>Datos de la Amortización Simulador</strong> </center> </b-alert>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Monto Original</th>
                                        <th class="text-center">Numero de Cuotas</th>
                                        <th class="text-center">Interes %</th>
                                        <th class="text-center">Monto Mensual Promedio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">$ {{SaldoDeuda}}</td>
                                        <td class="text-center">{{calcularPeriodo}}</td>
                                        <td class="text-center">{{interes}} %</td>
                                        <td class="text-center">$ {{cuota_fija2}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button type="button" @click="donwloadPdf" class="btn btn-sm btn-danger" style="float: right;"><i class="nav-icon far fa-file-pdf"></i> Descargar</button>
                            </div> 
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="table-responsive">
                            <b-alert show variant="secondary"><center><i class="fas fa-chart-pie"></i> <strong>Tabla de Amortización Simulador</strong> </center> </b-alert>

                            <table class="table table-bordered table-hover table-striped ">
                                <thead>
                                    <tr>
                                        <th class="text-center"># Periodos</th>
                                        <th class="text-center">Fecha de pago</th>
                                        <th class="text-center">Saldo inicial</th>
                                        <th class="text-center">Cuota fija</th>
                                        <th class="text-center">Interes</th>
                                        <th class="text-center">Abono al capital</th>     
                                        <th class="text-center">Saldo final</th>      
                                                                            
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index) in arrayData" :key="data.id">
                                        <td class="text-center">{{ index + 1  }}</td>
                                        <td>{{ data.fecha_pago }}</td>  
                                        <td class="text-center">$ {{ data.saldo_inicial }}</td>
                                        <td class="text-center">$ {{ data.cuota }}</td>
                                        <td class="text-center">$ {{ data.interes }}</td>
                                        <td class="text-center">$ {{ data.abono }}</td>
                                        <td class="text-center">$ {{ data.saldo_final }}</td>                 
                                                        
                                    </tr>
                                </tbody>         
                            </table>
                        </div>   
                    </div>
                </template>
                <div class="row">
                   
                    <div class="table-responsive"> 
                        <b-alert show variant="primary"><center><i class="fas fa-chart-pie"></i> <strong>Amortización Generadas</strong> </center> </b-alert>
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Deuda $</th>
                                    <th>Periodo</th>
                                    <th>Interés</th>
                                    <th>Cuota</th>
                                    <th>Abono</th>     
                                    <th>Asesor</th>
                                    <th>Estado</th>       
                                    <th>Fecha de pago</th>     
                                    <th colspan="2">Acciones</th>     
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pago, index) in pagos" :key="pago.id">
                                    <td>{{( index + 1 )}}</td>
                                    <td>$ {{ pago.saldodeuda }}</td>
                                    <td>{{ pago.periodo }} mes(es)</td>
                                    <td>{{ pago.interes }} %</td>
                                    <td>$ {{ pago.cuota }}</td>
                                    <td>$ {{ pago.abono }}</td>
                                    <td>{{ pago.user.apellido_paterno }} {{ pago.user.nombre1 }} </td>
                                    <td v-if="pago.estado==1"><b-badge variant="success">Activo</b-badge></td>
                                    <td v-else><b-badge variant="danger">Descartado</b-badge></td>
                                    <td>{{ pago.fecha_pago }}</td>
                            
                                    <td>    
                                        <button type="button" @click="getcuotas(pago.id)" class="btn btn-sm btn-info" ><i class="fa fa-eye"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" @click="donwloadPdf" class="btn btn-sm btn-danger" style="float: right;"><i class="nav-icon far fa-file-pdf"></i> Descargar</button>    
                                        <!--<button type="button" @click="deletePago(pago.id)" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></button>-->
                                    </td>

                                </tr>
                            </tbody>         
                        </table>
                    </div>
                </div>
                <div class="row" v-if="getcuota">
                   
                    <div class="table-responsive"> 
                        <b-alert show variant="primary"><center><i class="fas fa-chart-pie"></i> <strong>Tabla de Amortización</strong> </center> </b-alert>
                        
                       <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th class="text-center"># Periodos</th>
                                    <th class="text-center">Fecha de pago</th>
                                    <th class="text-center">Saldo inicial</th>
                                    <th class="text-center">Cuota fija</th>
                                    <th class="text-center">Interes</th>
                                    <th class="text-center">Abono al capital</th>     
                                    <th class="text-center">Saldo final</th>      
                                                                        
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, index) in getcuotadetalle" :key="data.id">
                                    <td class="text-center">{{ index + 1  }}</td>
                                    <td>{{ data.fecha_pago }}</td>  
                                    <td class="text-center">$ {{ data.saldo_inicial }}</td>
                                    <td class="text-center">$ {{ data.cuota }}</td>
                                    <td class="text-center">$ {{ data.interes }}</td>
                                    <td class="text-center">$ {{ data.abono }}</td>
                                    <td class="text-center">$ {{ data.saldo_final }}</td>                 
                                                    
                                </tr>
                            </tbody>         
                        </table>
                    </div>
                </div>

                 <div class="row" v-if="getcuota">
                    <div class="table-responsive"> 
                        <b-alert show variant="primary"><center><i class="fas fa-chart-pie"></i> <strong>Detalle del Pago</strong> </center> </b-alert>
                        <table class="table table-bordered table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th># Cuotas</th>
                                    <th>Interés Total</th>
                                    <th>Monto en Cuotas</th>
                                    <th>Abono Total</th>
                                    <th>Fecha Inicio</th>     
                                    <th>Fecha Fin</th>       
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pago, index) in getcuota" :key="index">
                                    <td>{{ pago.CantCuotas }} mes(es)</td>
                                    <td>$ {{ pago.interes }}</td>
                                    <td>$ {{ pago.Montocuota }}</td>
                                    <td>$ {{ pago.MontoAbono }}</td>
                                    <td>{{ pago.Incio_fecha_pago }}</td>
                                    <td>{{ pago.ultima_fecha_pago }}</td>
                                </tr>
                            </tbody>         
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
	import axios from 'axios'
    import swal from 'sweetalert2'
    import jsPDF from 'jspdf';
    import autoTable from 'jspdf-autotable';
    export default {
        props: ['id','saldodeuda'],
    	data () {
                 const now = new Date()
                const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
                // 15th two months prior
                const minDate = new Date(today)
                minDate.setMonth(minDate.getMonth())
                minDate.setDate(now.getDate())
                // 15th in two months
                const maxDate = new Date(today)
                maxDate.setMonth(maxDate.getMonth() + 1)
                maxDate.setDate(15)

            return {
                idcampana: String(this.id),
               
                cliente: [],
                pagos: [],
                url: 'http://damplus.estudiojuridicomedina.com/',
                abono: parseFloat((this.saldodeuda/2).toFixed(2)),
                periodo: 0,
                interes: 0.8,
                fecha_pago: '',
                cuota: 0.0,
                errorMostrarMsgPago: [],
                errorPago: 0,
                amortizar: false,
                arrayData : [],
                SaldoDeuda: String(this.saldodeuda),
                cuota_fija2: '',
                        
                min: minDate,
                max: maxDate,
                getcuota: null,
                getcuotadetalle: null
            }
        },
        
        computed: {
            calcularPeriodo() 
            {
                let me = this     
                me.periodo = Math.round((parseFloat(me.SaldoDeuda) - parseFloat(me.abono)) / parseFloat(me.cuota))
                return Math.round(me.periodo)
            }
        },
        methods: {
            
            getCampanaCliente()
            {
          
                let me = this
                     
                axios.get(`${me.url}getcliente/${me.idcampana}`)
                    .then(res => {
                        me.cliente = res.data 
                    }).catch(err => {
                        console.log(err)
                })
                  
            },
            getPagos()
            {
                let me = this
                axios.get(`${me.url}apipago/index?id=${me.idcampana}`)
                    .then(res => {
                        me.pagos = res.data 
                    })
                    .catch(err => {
                        console.log(err)
                    })
                                          

            },
            nuevaFecha(fecha, intervalo, dma) {
                let arrayFecha = fecha.split('-')
                let anio = arrayFecha[0]
                let mes = arrayFecha[1]
                let dia = arrayFecha[2]  
                  
                let fechaInicial = new Date(anio, mes - 1, dia);
                let fechaFinal = fechaInicial;
                if(dma=="m" || dma=="M")
                {
                    fechaFinal.setMonth(fechaInicial.getMonth() + parseInt(intervalo));
                }
                else if(dma=="y" || dma=="Y")
                {
                    fechaFinal.setFullYear(fechaInicial.getFullYear() + parseInt(intervalo));
                }
                else if(dma=="d" || dma=="D")
                {
                    fechaFinal.setDate(fechaInicial.getDate() + parseInt(intervalo));
                }
                else
                {
                    return fecha;
                }
                dia = fechaFinal.getDate();
                mes = fechaFinal.getMonth() + 1;
                anio = fechaFinal.getFullYear();
                 
                dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
                mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
                 
                return anio + "-" + mes + "-" + dia;
            },
            formatDate(date) {
                let arrayFecha = date.split('-')
                let year = arrayFecha[0]
                let month = arrayFecha[1]
                let day = arrayFecha[2]  
                  
                let fecha = new Date(year, month - 1, day);
                let meses = [
                    "01", "02", "03",
                    "04", "05", "06", "07",
                    "08", "09", "10",
                    "11", "12"
                ];
                let dia = fecha.getDate();
                let mesIndice = fecha.getMonth();
                let anio = fecha.getFullYear();
                return anio + '-' + meses[mesIndice] + '-' + dia;
            },
            calculate()
            {
                this.getcuota=null
                this.getcuotadetalle=null
                if(this.validate())
                {
                    return
                }
                else
                {
                    let me = this
                    if (me.SaldoDeuda < 0.1)
                    {
                        swal(
                            'Error',
                            'El cliente no tiene deuda para crear un plan de pago',
                            'error'
                        )
                    }
                    else
                    {  
                        me.amortizar = true
                        me.arrayData = []

                        let object = {}
                        let monto_cobrar = Math.round(parseFloat(me.SaldoDeuda) - parseFloat(me.abono), 3);
                        let interesDecimal = (parseFloat(me.interes) / 100);
                        let denominador = Math.pow((1 / (1 + parseFloat(interesDecimal))), parseFloat(me.periodo));
                        let cuota_fija = (parseFloat(interesDecimal) * parseFloat(monto_cobrar)) / (1 - parseFloat(denominador));
                        let intereses = 0.0
                        let amortizacion = 0.0
                        let saldo_final = 0.0
                        this.cuota_fija2 = parseFloat(cuota_fija.toFixed(2))
                        
                        for (var i = 1; i <= me.periodo; i++) 
                        {      
                            intereses = parseFloat(monto_cobrar) * parseFloat(me.interes / 100)
                            amortizacion = parseFloat(cuota_fija) - parseFloat(intereses)
                            saldo_final = parseFloat(monto_cobrar) - parseFloat(amortizacion) 
                            
                            object = {
                                id: i,
                                saldo_inicial: parseFloat(monto_cobrar.toFixed(2)),
                                cuota: parseFloat(cuota_fija.toFixed(2)),
                                interes: parseFloat(intereses.toFixed(2)),
                                abono: parseFloat(amortizacion.toFixed(2)),
                                fecha_pago: me.formatDate(me.nuevaFecha(me.fecha_pago, '+'+i, 'm')),
                                saldo_final: (parseFloat(saldo_final.toFixed(2)) < 0.1) ? 0 : parseFloat(saldo_final.toFixed(2))                  
                            }
                            me.arrayData.push(object)
                            monto_cobrar = object.saldo_final
                            object = {}
                        }
                    }
                }
            },  
            donwloadPdf()
            {
                let me = this
                let doc = new jsPDF('p', 'pt');
            
                let columns = [
                    {title: "# Periodos", dataKey: "id"},
                    {title: "Fecha de pago", dataKey: "fecha_pago"},
                    {title: "Saldo inicial", dataKey: "saldo_inicial"},
                    {title: "Cuota fija", dataKey: "cuota"},
                    {title: "Interés", dataKey: "interes"},
                    {title: "Abono", dataKey: "abono"},
                    
                    {title: "Saldo final", dataKey: "saldo_final"},
                ];
                doc.text('Amortización del cliente '+me.cliente.Nombres, 10, 18)
                doc.autoTable(columns, me.arrayData)
                doc.save('amortizacion-'+(me.cliente.idcampana + me.cliente.cedula)+'.pdf')
            },
            postPago()
            {
                if(this.validate())
                {
                    return
                }
                else
                {
                    let me = this
                    if (me.SaldoDeuda < 0.1)
                    {
                        swal(
                            'Error',
                            'El cliente no tiene deuda para crear un plan de pago',
                            'error'
                        )
                    }
                    else
                    {
                        let monto_cobrar = parseFloat(me.SaldoDeuda) - parseFloat(me.abono);
                        let interesDecimal = (parseFloat(me.interes) / 100);
                        let denominador = Math.pow((1 / (1 + parseFloat(interesDecimal))), parseFloat(me.periodo));
                        let cuota = (parseFloat(interesDecimal) * parseFloat(monto_cobrar)) / (1 - parseFloat(denominador));
                    const parametros ={
                            'campania_idc': (me.idcampana),
                            'periodo': me.periodo,
                            'interes': me.interes,
                            'cuota': parseFloat(cuota.toFixed(2)),
                            'abono': me.abono,
                            'fecha_pago': me.fecha_pago,
                            'monto_cobrar' : monto_cobrar,
                            'nombres': me.cliente.Nombres,
                            'saldoDeuda': me.SaldoDeuda,
                            'valorDeuda': me.cliente.ValorDeuda,
                            'campania': me.cliente.Descripcion,
                            'detalleCuota': me.arrayData
                    }

                        axios.post(this.url+'apipago/store', parametros)
                            .then(res => {
                            me.getPagos()
                            me.amortizar = false
                            swal(
                                'Correcto',
                                res.data.success,
                                'success'
                            )

                            me.resetError()
                          
                            me.reset()
                            monto_cobrar = 0.0
                            interesDecimal = 0.0
                            cuota = 0.0
                        }).catch(err => {
                            console.log(err.response.data)
                            me.amortizar = false
                            monto_cobrar = 0.0
                            interesDecimal = 0.0
                            cuota = 0.0
                            swal(
                                'Error',
                                err.response.data,
                                'error'
                            )
                        })
                    }
                    
                }
            },
            deletePago(id)
            {
                swal({
                    title: '¿Seguro que quieres eliminar el pago?',
                    text: "No podrás revertir esta acción luego",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si, borrarlo!'
                }).then((result) => {
                    if (result.value) 
                    {
                        let me = this
                        axios.delete(me.url+'apipago/'+id)
                        .then( res => {
                            me.getPagos()
                            swal(
                            'Borrarlo!',
                            'Pago eliminado.',
                            'success'
                            )
                        })
                        .catch( err => {
                            console.log(err)
                            let error = err.response.data
                            if (err.response.data == 'Unauthorized.') 
                            {
                                error = 'Usuario con rol no autorizado'
                            }
                            swal(
                                'Error',
                                error,
                                'error'
                            )
                        })
                    }
                })
            },
            validarAbonoNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.abono.length; i++)
                if (filtro.indexOf(this.abono.charAt(i)) != -1) 
                    out += this.abono.charAt(i)
                this.abono = out
            },
            validarCuotaNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.cuota.length; i++)
                if (filtro.indexOf(this.cuota.charAt(i)) != -1) 
                    out += this.cuota.charAt(i)
                this.cuota = out
            },
            validarInteresNumerico()
            {
                let out = ''
                let filtro = '1234567890.'
                
                for (let i=0; i < this.interes.length; i++)
                if (filtro.indexOf(this.interes.charAt(i)) != -1) 
                    out += this.interes.charAt(i)
                this.interes = out
            },
            resetError()
            {
                this.errorMostrarMsgPago = []
                this.errorPago = 0
            },
            reset()
            {
                let me = this
                me.fecha_pago = ''
                me.periodo = 0
                me.abono = 0.0
                me.interes = 0.0
                me.cuota = 0.0
                me.arrayData = []
                me.amortizar = false
            },
            validate () 
            {
                
                this.errorPago = 0
                this.errorMostrarMsgPago = []
                if(!this.abono || this.abono < 0) this.errorMostrarMsgPago.push("El abono no puede estar vacío")
                if(!this.periodo || this.periodo <= 0 || this.periodo == 'Infinity') this.errorMostrarMsgPago.push("El periodo no puede estar vacío")
                if(!this.cuota || this.cuota <= 0) this.errorMostrarMsgPago.push("Debe especificar la cuota")
                if(!this.interes || this.interes <= 0) this.errorMostrarMsgPago.push("El interés no puede estar vacío ni ser menor o igual a 0")
                if(!this.fecha_pago) this.errorMostrarMsgPago.push("La fecha de pago no puede estar vacío")
                
                if (this.errorMostrarMsgPago.length) this.errorPago = 1
                return this.errorPago
            },
            getcuotas(id){
                
                  axios.get(this.url+'getcuotas/'+id)
                        .then(res => {
                        this.getcuota = res.data;
                });

                  axios.get(this.url+'getcuotasdetalle/'+id)
                        .then(res => {
                        this.getcuotadetalle = res.data;
                });
            }
        },
        mounted() 
        {
            console.log('Componente pagos montado.')
            this.getCampanaCliente()
            this.getPagos()
           


        }
    }
</script>
