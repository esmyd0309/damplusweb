<template>
<div>
  <b-input-group>
    <b-input-group-prepend is-text>
      <b-form-checkbox switch class="mr-n2" v-model="tipobuscar" @input="TipoBuscar" @click="TipoBuscar(tipobuscar)" id="tooltip-button-interactive">
           <b-tooltip target="tooltip-button-interactive">Cambiar Para buscar Por Cedula</b-tooltip>
        <span class="sr-only">Switch for following text input</span>
      </b-form-checkbox>
    </b-input-group-prepend>
        <b-button id="link-button" tabindex="0">Buscar por <strong v-if="tipobuscar==false">Cedula</strong><strong v-else>Nombre</strong></b-button>
    <b-form-input v-model="datobuscar" aria-label="Text input with switch" @input="DatoBuscar" @click="DatoBuscar(datobuscar)"></b-form-input>
  </b-input-group>
    <hr>
    <div class="table-responsive" v-if="datobuscar">
        <table class="table table-striped-md">
            <thead class="thead-dark"> 
                <tr>
                    <th>ID</th>
                    <th>cedula</th>
                    <th>Nombres</th>
                    <th>Cartera</th>
                    <th>Area</th>
                    <th>Agente</th>
                    <th>Valor Deuda</th>
                    <th>Saldo Deuda</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody >
                <tr v-for="(item, index) in clientes" :key="index">
                
                    <td>{{ item.idc }}</td>
                    <td>{{ item.cedula }}</td>
                    <td>{{ item.Nombres }}</td>
                    <td>{{ item.descripcion }}</td>
                    <td>{{ item.area }}</td>
                    <td>{{ item.agente }}</td>
                    <td>{{ item.valordeuda }}</td>
                    <td>{{ item.saldodeuda }}</td>
                    
                
                    <td><button v-b-modal.modal-xl class="btn btn-outline-warning btn-sm" pill variant="success" @click="GestionarCliente(item)">Gestionar</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <b-modal id="modal-xl" size="xl" title="Datos Cliente" >
        Cliente                     <strong>{{ datoscliente.nombres }}</strong> 
        con cedula de indentidad    <strong> {{ datoscliente.cedula}}</strong> 
        posee una deuda actual de   <strong>${{ datoscliente.saldodeuda }}</strong> 
        en la cartera               <strong>{{ datoscliente.cartera }}</strong>
        <hr>
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
                <b-col md="3">
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
                <b-col md="3">
                     <b-input-group prepend="Estado" class="mb-2 mr-sm-2 mb-sm-0">
                        <select v-model="form.estado">
                            <option v-for="(item, index) in options" :key="index"  v-bind:value="item.value " >
                                {{ item.text }}
                            </option>
                        </select>
                    </b-input-group>
                </b-col>
                <b-col md="3" v-if="form.estado=='compromiso'">
                    <b-form-datepicker  id="datepicker-invalid" :state="comprobar.fechapagar" v-model="form.fechapagar" class="mb-2">
                    </b-form-datepicker>
                </b-col>
                <b-col md="3" v-if="form.estado=='compromiso'">
                   <b-input-group prepend="Valor" class="mb-2 mr-sm-2 mb-sm-0">
                        <b-form-input  
                            id="input-valid" 
                            placeholder="$ 222,22"
                            v-model="form.valor"
                        >
                        </b-form-input>
                    </b-input-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="6">
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

                <b-col md="3" v-if="form.estado=='compromiso'">
                     <b-input-group prepend="Forma Pago" class="mb-2 mr-sm-2 mb-sm-0">
                        <select v-model="form.forma">
                            <option v-for="(item, index) in formaspago" :key="index"  v-bind:value="item.value " >
                                {{ item.text }}
                            </option>
                        </select>
                    </b-input-group>
                </b-col>
                
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
</div>
</template>

<script>

  export default {
    data() {
      return {
        datobuscar: null,
        clientes: null,
        tipobuscar: false,
        clientedetalle: null,
        datoscliente: {
            cedula: '',
            idc: '',
            nombres: '',
            area: '',
            cartera: '',
            saldovalor: '',
            valordeuda: ''
        },
        form: {
            telefono: '',
            fecha: '',
            comentario: '',
            estado: '',
            fechapagar: '',
            valor: '',
            forma: ''

        },
        options: [
            { text: 'compromiso', value: 'compromiso' },
            { text: 'Efectivo', value: 'Efectivo' },
            { text: 'Efectivo Tercero', value: 'Efectivo Tercero' }
        ],
        formaspago: [
            { text: 'transferencia', value: 'transferencia' },
            { text: 'deposito', value: 'deposito' },
            { text: 'oficina', value: 'oficina' },
            { text: 'terreno', value: 'terreno' }
        ],
        errors: [],
        gestiones: [],
        crear: false,
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
        DatoBuscar(event) {
            if (event) {
                axios.get('apiclientescobranza/'+event+'/'+this.tipobuscar)
                    .then(res => {
                        this.clientes = res.data;
                });
                
            }
            
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
            if (this.form.estado!='compromiso') {
                this.form.valor             = '';
                this.form.forma             = '';
                this.form.fechapagar        = '';
            }
                const parametros = {
                                        telefono:       this.form.telefono,
                                        comentario:     this.form.comentario,
                                        estado:         this.form.estado,
                                        idc:            this.datoscliente.idc,
                                        cedula:         this.datoscliente.cedula,
                                        fechapagar:     this.form.fechapagar,
                                        valor:          this.form.valor,
                                        forma:          this.form.forma,


                                        
                                    }
                                 
                
                this.form.telefono          = '';
                this.form.comentario        = '';
                this.form.estado            = '';

                this.form.valor             = '';
                this.form.forma             = '';
                this.form.fechapagar        = '';

                //console.log(parametros)

                axios.post('apiclientescobranzaguardar',parametros)
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