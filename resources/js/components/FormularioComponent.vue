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
                    
                
                    <td><button v-b-modal.modal-xl class="btn btn-outline-warning btn-sm" @click="GestionarCliente(item)">Gestionar</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <b-modal id="modal-xl" size="xl" title="Datos Cliente" >Cliente <strong>{{ datoscliente.nombres }} </strong> </b-modal>
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
            cartera: ''
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

        }
     }

  }
</script>