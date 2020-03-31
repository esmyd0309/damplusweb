<template>
<div>

   
    <!-- MODAL CREAR GESTIONES --->
    <b-modal id="modal-xl" size="xl" title="Datos Cliente" >
        <center>
            <b-button  variant="primary" v-model="crear" @click="crear=true" v-if="!crear">
                 <i class="fas fa-plus"></i>
            </b-button>
        </center>
        
        <form  v-on:submit.prevent="checkForm" v-if="crear">
            <p v-if="errors.length">
                    <ul>
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </p>
            <b-row>
                <b-col md="4">
                    <b-input-group prepend="Telefono" class="mb-2 mr-sm-2 mb-sm-0">
                        <b-form-input  
                            id="input-valid" 
                            :state="comprobar.telefono" 
                            placeholder="Telefono..."  
                            v-model="form.telefono"
                            max="10"
                        >
                        </b-form-input>
                    </b-input-group>
                    <small v-if="!comprobar.telefono">Es Obligatorio y un minimo de 9 Caracteres</small>
                </b-col>
                <b-col md="4">
                     <b-input-group prepend="Estado" class="mb-2 mr-sm-2 mb-sm-0">
                        <select v-model="form.estado">
                            <option v-for="(item, index) in options" :key="index"  v-bind:value="item.value " >
                                {{ item.text }}
                            </option>
                        </select>
                    </b-input-group>
                </b-col>
                <b-col md="4">
                     <b-input-group prepend="Comentario" class="mb-2 mr-sm-2 mb-sm-0">
                        <b-form-textarea  
                            id="input-valid" 
                            :state="comprobar.comentario" 
                            placeholder="comentario..."  
                            v-model="form.comentario"
                        >
                        </b-form-textarea>
                    </b-input-group>
                    <small v-if="!comprobar.comentario">Es Obligatorio y un minimo de 20 Caracteres</small>
                </b-col>
            </b-row>
            <br>
            <b-row>
                <b-col md="4" v-if="form.estado=='compromiso'">
                    <b-form-group label="Fecha Deposito : " label-for="file-small" label-cols-sm="4" label-size="sm">
                        <b-form-datepicker  id="datepicker-invalid"  v-model="form.fechapagar" class="mb-2">
                        </b-form-datepicker>
                    </b-form-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='compromiso'">
                   <b-input-group prepend="Valor" class="mb-2 mr-sm-2 mb-sm-0">
                        <b-form-input  
                            id="input-valid" 
                            placeholder="$ 222,22"
                            v-model="form.valorcompromiso"
                        >
                        </b-form-input>
                    </b-input-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='compromiso'">
                     <b-input-group prepend="Forma Pago" class="mb-2 mr-sm-2 mb-sm-0">
                        <select v-model="form.formapagocompromiso">
                            <option v-for="(item, index) in formaspago" :key="index"  v-bind:value="item.value " >
                                {{ item.text }}
                            </option>
                        </select>
                    </b-input-group>
                </b-col>
            </b-row>
            <br>
            <b-row>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                    <b-form-group label="Fecha Deposito : " label-for="file-small" label-cols-sm="4" label-size="sm">
                        <b-form-datepicker  id="datepicker-invalid"  v-model="form.fecharecaudacion" class="mb-2">
                        </b-form-datepicker>
                    </b-form-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                   <b-input-group prepend="Valor" class="mb-2 mr-sm-2 mb-sm-0">
                        <b-form-input  
                            id="input-valid" 
                            placeholder="$ 222,22"
                            v-model="form.valorrecaudo"
                        >
                        </b-form-input>
                    </b-input-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                    <b-form-group label="Recibo: " label-for="file-small" label-cols-sm="2" label-size="sm">
                        <b-form-file id="file-small" size="sm" v-model="form.archivo"></b-form-file>
                    </b-form-group>
                </b-col>
            </b-row>
            <br>
            <b-row>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                   <b-input-group prepend="Banco Destino" class="mb-2 mr-sm-2 mb-sm-0" label-size="sm">
                        <select v-model="form.bancodestino" :value="form.bancodestino" class="form-control mb-2" >
                            <option value="" disabled>Seleccione un Banco </option>
                            <option v-for="(item, index) in bancos" :key="index" v-bind:value="item.nombre">{{ item.nombre }}</option>
                        </select>
                    </b-input-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                    <b-input-group prepend="Banco Origen" class="mb-2 mr-sm-2 mb-sm-0" >
                        <select v-model="form.bancoorigen" :value="form.bancoorigen" class="form-control mb-2" >
                            <option value="" disabled>Seleccione un Banco  </option>
                            <option v-for="(item, index) in bancos" :key="index" v-bind:value="item.nombre">{{ item.nombre }}</option>
                        </select>
                    </b-input-group>
                </b-col>
                <b-col md="4" v-if="form.estado=='recaudacion'">
                     <b-input-group prepend="Forma Pago" class="mb-2 mr-sm-2 mb-sm-0">
                        <select v-model="form.formarecaudo">
                            <option v-for="(item, index) in formaspago" :key="index"  v-bind:value="item.value " >
                                {{ item.text }}
                            </option>
                        </select>
                    </b-input-group>
                </b-col>
            </b-row>
            <br>
            <b-row>
                
                
            </b-row>
            <input  class="btn btn-primary btn-sm" type="submit" value="CREAR">
        </form>
        <b-row>
            <b-col md="12" >
                    <div class="table-responsive">
                        <table class="table table-striped-md">
                            <thead class="thead-dark"> 
                                <tr>
                                    <th>Registrado</th>
                                    <th>Idc</th>
                                    <th>Agente</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Fecha Conpromiso</th>
                                    <th>Valor a Pagar</th>
                                    <th>Forma Pago</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in gestiones" :key="index">
                                    <td>{{ item.fecha }}</td>
                                    <td>{{ item.idc }}</td>
                                    <td>{{ item.agente }}</td>
                                    <td>{{ item.telefono }}</td>
                                    <td><span class="badge badge-warning float-center">{{ item.estado }}</span></td>
                                    <td>{{ item.comentario }}</td>
                                    
                                    <td>{{ item.fechapagar }}</td>
                                    <td>{{ item.valor }}</td>
                                    <td>{{ item.formapago }}</td>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-col>
        </b-row>
    </b-modal>
    <!--- / MODAL CREAR GESTIONES -->


</div>
</template>

<script>

  export default {
    props: {
        id: {
        default: 1
        },
    },
    data() {
        return {
            
            form: {
                telefono: '',
                prefijo: '',
                convensional: '',
                comentario: '',
                
            }
        }
    },
    computed: {
        comprobar()
        {
            return  { 
                telefono: this.form.telefono.length > 9 ? true : false,
                comentario: this.form.comentario.length > 9 ? true : false,
                fechapagar: this.form.fechapagar.length > 1 ? true : false

                
            }
        }
            
    },
    beforeMount() {
      
                
    },
    methods:{
        TipoBuscar(event) {
            this.datobuscar = ''
            this.tipobuscar = event
        },
       
        GestionarCliente(item){
            this.datoscliente.idc = item.idc
            this.datoscliente.cedula = item.cedula
            this.datoscliente.nombres = item.Nombres
            this.datoscliente.cartera = item.descripcion
            this.datoscliente.area = item.area
            this.datoscliente.valordeuda = item.valordeuda
            this.datoscliente.saldodeuda = item.saldodeuda

            axios.get('apiclientescobranzagestiones/'+item.idc)
            .then(res => {
                this.gestiones = res.data;
            });

        },
        agregar(){

            if (this.form.estado=='compromiso') {
                 this.parametros = {
                                        telefono:           this.form.telefono,
                                        comentario:         this.form.comentario,
                                        estado:             this.form.estado,
                                        idc:                this.datoscliente.idc,
                                        cedula:             this.datoscliente.cedula,
                                        fechapagar:         this.form.fechapagar,
                                        valorcompromiso:    this.form.valorcompromiso,
                                        formapagocompromiso: this.form.formapagocompromiso
                                        
                                    }
            }

            if (this.form.estado=='recaudacion') {
                 this.parametros = {
                                        telefono:           this.form.telefono,
                                        comentario:         this.form.comentario,
                                        estado:             this.form.estado,
                                        idc:                this.datoscliente.idc,
                                        cedula:             this.datoscliente.cedula,
                                        fecharecaudacion:   this.form.fecharecaudacion,
                                        formarecaudo:       this.form.formarecaudo,
                                        valorrecaudo:       this.form.valorrecaudo,
                                        bancoorigen:        this.form.bancoorigen,
                                        bancodestino:       this.form.bancodestino,
                                        archivo:            this.form.archivo
                                    }
            }
            if (this.form.estado!='recaudacion' && this.form.estado!='compromiso') {
                this.parametros = {
                                        telefono:       this.form.telefono,
                                        comentario:     this.form.comentario,
                                        estado:         this.form.estado,
                                        idc:            this.datoscliente.idc,
                                        cedula:         this.datoscliente.cedula
                                        
                                        
                                    }
            }
                                 
                console.log(this.parametros)
                this.form.telefono              = '';
                this.form.comentario            = '';
                this.form.estado                = '';
                this.form.valor                 = '';
                this.form.formapagocompromiso   = '';
                this.form.fechapagar            = '';
                this.form.formarecaudo          = '';
                this.form.bancoorigen           = '';
                this.form.bancodestino          = '';
                this.form.valorcompromiso       = '';
                this.form.archivo               = '';
                this.form.archivo               = '';
           

           
                axios.post('apiclientescobranzaguardar',this.parametros)
                .then(res => {
                    this.gestiones.push(res.data)
                     this.$swal('Creado con Exito');
                });

               this.crear = false
                
                
            },
            checkForm: function(){
                this.errors = [];
                if(!this.form.telefono){
                    this.errors.push('El Telefono es Obligatorio');
                }
                if(!this.form.comentario){
                    this.errors.push('El comentario es Obligatorio');
                }
                
                if(!this.form.estado){
                    this.errors.push('Seleccione un estado');
                }
                  
                
                
                if(this.form.telefono && this.form.comentario && this.form.estado ){
                    this.agregar();
                }
            },
     }

  }
</script>