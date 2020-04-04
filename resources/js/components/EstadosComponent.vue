<template>
    <div>
        
        <b-button class="btn btn-primary btn-sm" @click="show=true" v-b-modal.modal-xl variant="primary"><i class="fas fa-plus-circle"></i> Estado</b-button>

        <b-modal 
            id="modal-xl" 
            size="xl" 
            title="Agregar un Estado" 
            v-model="show"
            :header-bg-variant="headerBgVariant"
            :header-text-variant="headerTextVariant"
            :body-bg-variant="bodyBgVariant"
            :body-text-variant="bodyTextVariant"
            :footer-bg-variant="footerBgVariant"
            :footer-text-variant="footerTextVariant"            
        >

            <form  v-on:submit.prevent="checkForm">
                <p v-if="errors.length">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                {{ error }}
                            </li>
                        </ul>
                    </p>
                <b-row>
                    <b-col md="3">
                            <b-input-group prepend="Tipo" class="mb-2 mr-sm-2 mb-sm-0" >
                            <select v-model="form.tipo" class="form-control" required>
                                <option v-for="(item, index) in tipos" :key="index"  v-bind:value="item.value " >
                                    {{ item.text }}
                                </option>
                            </select>
                        </b-input-group>
                    </b-col>
                    <b-col md="3">
                            <b-input-group prepend="Grupo" class="mb-2 mr-sm-2 mb-sm-0">
                            <select v-model="form.grupo" class="form-control" required>
                                <option v-for="(item, index) in getgrupoestados" :key="index"  v-bind:value="item.id " >
                                    {{ item.nombre }}
                                </option>
                            </select>
                        </b-input-group>
                    </b-col>
                    <b-col md="4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Nombre</label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.nombre" 
                                placeholder="Nombre.../ titulo"  
                                v-model="form.nombre"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.nombre">Es Obligatorio y un minimo de 5 Caracteres</small>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Descripcion</label>
                            </div>
                            <b-form-textarea  
                                id="input-valid" 
                                :state="comprobar.descripcion" 
                                placeholder="Descripcion..."  
                                v-model="form.descripcion"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.descripcion">Es Obligatorio y un minimo de 10 Caracteres</small>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="2">
                        <b-col>
                        <b-form-checkbox v-model="form.estado">
                            Estado 
                        </b-form-checkbox>
                    </b-col>
                    </b-col>

                    <b-col md="4">
                        <b-button type="submit"  class="mt-3" variant="outline-success" block >Crear Estado</b-button>
                    </b-col>

                    <b-col md="4">
                        

                         <b-button class="mt-3" variant="outline-danger" block @click="show=false">Cerrar</b-button>
                    </b-col>
                    <b-col md="2">
                    </b-col>
                </b-row>


            </form>
          <template v-slot:modal-footer>
        <div class="w-100">
          <p class="float-left">Debe llenar todo los campos requeridos</p>
        </div>
      </template>
        </b-modal>
        

    </div>
</template>

<script>
import axios from 'axios'
import Vue from "vue";
import 'whatwg-fetch';
import VueSwal from 'vue-swal'
import VueSweetalert2 from 'vue-sweetalert2';
import EventBus from "../event-bus";
import Gestiones from "./GestionesComponent";


const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
 Vue.use(VueSweetalert2, options);
Vue.use(EventBus)

Vue.use(VueSwal)
export default {
    name: 'estados',

     data() {
        return {

            form: {
                tipo: '',
                nombre: '',
                descripcion: '',
                estado: true,
                grupo: ''
                
            },
            tipos: [
                { text: 'CONTACTO', value: 'CONTACTO' },
                { text: 'NO CONTACTO', value: 'NO CONTACTO' },
                { text: 'GESTION', value: 'GESTION' }
            ],
            
            
            errors: [],
            crear: true,
            estadoadd: [],
            getgrupoestados: [],
            show: false,
            variants: ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'],
            headerBgVariant: 'dark',
            headerTextVariant: 'light',
            bodyBgVariant: 'light',
            bodyTextVariant: 'dark',
            footerBgVariant: 'warning',
            footerTextVariant: 'dark',
            enlace: 'http://damplus.estudiojuridicomedina.com/'
        }
    },
    computed: {


        comprobar()
        {
            return  { 
                
                nombre: this.form.nombre.length > 5 ? true : false,
                descripcion: this.form.descripcion.length > 10 ? true : false,
                
                
            }
        }
            
    },
    beforeMount() {
              
                 axios.get(this.enlace+'getgrupoestados')
                        .then(res => {
                        this.getgrupoestados = res.data;
            });
    },
    created() {
        
    },
    methods:{
    
      
        agregar(){
            const parametros  = 
                {
                    nombre:           this.form.nombre,
                    estado:           this.form.estado,
                    descripcion:      this.form.descripcion,
                    tipo:             this.form.tipo,                              
                    grupo:             this.form.grupo 
                    
                }
           
                this.form.nombre  = '';
                this.form.estado  = '';
                this.form.descripcion  = '';
                this.form.grupo  = '';

                axios.post(this.enlace+'estadosAdd',parametros)
                .then(res => {
                    this.estadoadd.push(res.data)
                    this.$swal('Estado Creado con Exito');
                });
               
                  this.show=false
            },
            checkForm: function(){
                this.errors = [];
                if(!this.form.nombre){
                    this.errors.push('El nombre es Obligatorio');
                }
                if(!this.form.descripcion){
                    this.errors.push('El descripcion es Obligatorio');
                }
                
                if(!this.form.tipo){
                    this.errors.push('Seleccione un tipo');
                }
                  
                
                
                if(this.form.nombre && this.form.descripcion && this.form.tipo ){
                    this.agregar();
                }
            },
     }
}
</script>