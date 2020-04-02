<template>
    <div>
        
        <b-button class="btn btn-primary btn-sm" @click="show=true" v-b-modal.modal-xl variant="primary"><i class="fas fa-plus-circle"></i> Gestiones</b-button>

        <b-modal 
            id="modal-xl" 
            size="xl" 
            title="Agregar una Gestión" 
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
                    <b-col md="4">
                            <b-input-group prepend="Tipo Contacto" class="mb-2 mr-sm-2 mb-sm-0">
                            <select v-model="form.contacto" class="form-control" required>
                                <option v-for="(item, index) in contacto" :key="index"  v-bind:value="item.value " >
                                    {{ item.text }}
                                </option>
                            </select>
                        </b-input-group>
                    </b-col>
                    <b-col md="4">
                            <b-input-group prepend="Estado" class="mb-2 mr-sm-2 mb-sm-0">
                            <select v-model="form.estado" class="form-control" required>
                                <option v-for="(item, index) in estado" :key="index"  v-bind:value="item.value " >
                                    {{ item.text }}
                                </option>
                            </select>
                        </b-input-group>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="4" v-if="form.contacto=='TELEFONICA'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Prefijo</label>
                            </div>
                            <select v-model="form.prefijo" class="form-control" required>
                                <option v-for="(item, index) in prefijo" :key="index"  v-bind:value="item.value " >
                                    {{ item.text }}
                                </option>
                            </select>
                        </div>
                    </b-col>
                    <b-col md="4" v-if="form.contacto=='TELEFONICA' && form.prefijo!='09'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Numero Convencional</label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.numero" 
                                placeholder="Numero Convencional solo 7 caracteres..."  
                                v-model="form.numero"
                                maxlength="7"
                                minlength="7"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.numero">Es Obligatorio y un max de 7 Caracteres</small>
                    </b-col>
                    <b-col md="4" v-if="form.contacto=='TELEFONICA' && form.prefijo=='09'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Numero Celular </label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.numero" 
                                placeholder="Numero Convencional solo 8 caracteres..."  
                                v-model="form.numero"
                                maxlength="8"
                                minlength="8"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.numero">Es Obligatorio y un max de 8 Caracteres</small>
                    </b-col>
                    <b-col md="3" v-if="form.contacto=='TELEFONICA'">
                        <strong > 
                            {{form.prefijo}} 
                            {{form.numero}}
                        </strong> 
                    </b-col>
                    <b-col md="4" v-if="form.contacto=='SMS'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Numero Celular </label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.telefono" 
                                placeholder="Numero Celular solo 10 caracteres..."  
                                v-model="form.telefono"
                                maxlength="10"
                                minlength="10"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.telefono">Es Obligatorio y un max de 10 Caracteres</small>
                    </b-col>
                    <b-col md="3" v-if="form.contacto=='SMS'">
                        <strong > 
                            <b-alert show variant="primary"><center>{{form.telefono}}</center></b-alert> 

                        </strong> 
                    </b-col>
                    <b-col md="3" v-if="form.contacto=='SMS'">
                        <b-form-checkbox v-model="form.respuestasms">
                            Respuesta 
                        </b-form-checkbox>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="6" v-if="form.contacto=='SMS'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Enviado</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajeenviado" 
                                placeholder="sms enviado..."  
                                v-model="form.mensajeenviado"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajeenviado">Es Obligatorio y un minimo de 10 Caracteres</small>
                    </b-col>
                    <b-col md="6" v-if="form.contacto=='SMS' && this.form.respuestasms==true">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Respuesta</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajerespuesta" 
                                placeholder="sms recibido..."  
                                v-model="form.mensajerespuesta"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajerespuesta">Es Obligatorio y un minimo de 10 Caracteres</small>
                    </b-col>
                    
                    <b-col md="4" v-if="form.contacto=='WHATSAPP'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Whatsapp</label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.telefono" 
                                placeholder="Whatsapp..."  
                                v-model="form.telefono"
                                maxlength="10"
                                minlength="10"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.telefono">Es Obligatorio y un minimo de 10 Caracteres</small>
                    </b-col>
                        <b-col md="3" v-if="form.contacto=='WHATSAPP'">
                        <strong > 
                            <b-alert show variant="primary">{{form.telefono}}</b-alert> 
                        </strong> 
                    </b-col>
                        <b-col md="3" v-if="form.contacto=='WHATSAPP'">
                        <b-form-checkbox v-model="form.repuestawhatsapp">
                            Respuesta 
                        </b-form-checkbox>
                    </b-col>
                        <b-col md="6" v-if="form.contacto=='WHATSAPP'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Enviado</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajeenviado" 
                                placeholder="whatsapp enviado..."  
                                v-model="form.mensajeenviado"
                                maxlength="255"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajeenviado">Es Obligatorio y un minimo de 15 Caracteres</small>
                    </b-col>
                        <b-col md="6" v-if="form.contacto=='WHATSAPP' && this.form.repuestawhatsapp==true">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Respuesta</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajerespuesta" 
                                placeholder="whatsapp recibido..."  
                                v-model="form.mensajerespuesta"
                                maxlength="255"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajerespuesta">Es Obligatorio y un minimo de 15 Caracteres</small>
                    </b-col>
                        <b-col md="4" v-if="form.contacto=='EMAIL'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Email</label>
                            </div>
                            <b-form-input  
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.email" 
                                placeholder="Email@.com..."  
                                v-model="form.email"
                                required
                            >
                            </b-form-input>
                        </div>
                        <small v-if="!comprobar.telefono">Es Obligatorio y un minimo de 10 Caracteres</small>
                    </b-col>
                    <b-col md="3" v-if="form.contacto=='EMAIL'">
                        <b-form-checkbox v-model="form.respuestaemail">
                            Respuesta 
                        </b-form-checkbox>
                    </b-col>
                        <b-col md="6" v-if="form.contacto=='EMAIL'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Enviado</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajeenviado" 
                                placeholder="whatsapp enviado..."  
                                v-model="form.mensajeenviado"
                                maxlength="255"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajeenviado">Es Obligatorio y un minimo de 15 Caracteres</small>
                    </b-col>
                        <b-col md="6" v-if="form.contacto=='EMAIL' && this.form.respuestaemail==true">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Mensaje Respuesta</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.mensajerespuesta" 
                                placeholder="whatsapp recibido..."  
                                v-model="form.mensajerespuesta"
                                maxlength="255"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.mensajerespuesta">Es Obligatorio y un minimo de 15 Caracteres</small>
                    </b-col>
                        <b-col md="6" v-if="form.contacto=='TERRENO'">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Dirección</label>
                            </div>
                            <b-form-textarea
                                class="form-control"
                                id="input-valid" 
                                :state="comprobar.terreno" 
                                placeholder="Dirección de Visita..."  
                                v-model="form.terreno"
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.telefono">Es Obligatorio y un minimo de 20 Caracteres</small>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" >Comentario</label>
                            </div>
                            <b-form-textarea  
                                id="input-valid" 
                                :state="comprobar.comentario" 
                                placeholder="comentario..."  
                                v-model="form.comentario"
                                required
                            >
                            </b-form-textarea>
                        </div>
                        <small v-if="!comprobar.comentario">Es Obligatorio y un minimo de 20 Caracteres</small>
                    </b-col>
                </b-row>
                <br>
                <b-row>
                    <b-col md="2">
                    </b-col>

                    <b-col md="4">
                        <b-button type="submit"  class="mt-3" variant="outline-success" block >Crear Gestion</b-button>
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
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
 Vue.use(VueSweetalert2, options);

Vue.use(VueSwal)
export default {
    name: 'gestiones',

    props: {
        id: {
        default: 1
        },
        cedula: {
        default: 1
        },
    },
     data() {
        return {

            form: {
                contacto: '',
                numero: '',
                terreno: '',
                prefijo: '',
                comentario: '',
                estado: '',
                telefono: '',
                respuestasms: false,
                repuestawhatsapp: false,
                respuestaemail: false,
                mensajeenviado: '',
                mensajerespuesta: '',
                
            },
            contacto: [
                { text: 'TELEFONICA', value: 'TELEFONICA' },
                { text: 'SMS', value: 'SMS' },
                { text: 'WHATSAPP', value: 'WHATSAPP' },
                { text: 'EMAIL', value: 'EMAIL' },
                { text: 'TERRENO', value: 'TERRENO' }
            ],
            estado: [
                { text: 'CONTACTO TITULAR', value: 'CONTACTO TITULAR' },
                { text: 'CONTACTO TERCERO', value: 'CONTACTO TERCERO' },
                { text: 'ENVIO DE DATOS', value: 'ENVIO DE DATOS' },
                { text: 'RECORDATORIO DE DEUDA', value: 'RECORDATORIO DE DEUDA' },
                { text: 'RECORDATORIO DE PAGO', value: 'RECORDATORIO DE PAGO' },
                { text: 'INCUMPLIMIENTO', value: 'INCUMPLIMIENTO' },
                { text: 'AGRADECIMIENTO', value: 'AGRADECIMIENTO' }
            ],
            prefijo: [
                { text: '02', value: '02' },
                { text: '03', value: '03' },
                { text: '04', value: '04' },
                { text: '05', value: '05' },
                { text: '06', value: '06' },
                { text: '07', value: '07' },
                { text: '08', value: '08' },
                { text: '09', value: '09' },
            ],
            errors: [],
            crear: true,
            gestiones: [],
            show: false,
            variants: ['primary', 'secondary', 'success', 'warning', 'danger', 'info', 'light', 'dark'],
            headerBgVariant: 'dark',
            headerTextVariant: 'light',
            bodyBgVariant: 'light',
            bodyTextVariant: 'dark',
            footerBgVariant: 'warning',
            footerTextVariant: 'dark',
           // enlace: 'http://localhost/damplusweb/public/'
        }
    },
    computed: {


        comprobar()
        {
            return  { 
                
                numero: (this.form.prefijo+this.form.numero).length >= 9 ? true : false,
                comentario: this.form.comentario.length > 15 ? true : false,
                mensajeenviado: this.form.mensajeenviado.length > 15 ? true : false,
                mensajerespuesta: this.form.mensajerespuesta.length > 15 ? true : false,
                telefono: this.form.telefono.length >= 10 ? true : false,
                
                
            }
        }
            
    },
    created() {
    },
    methods:{
    
      
        agregar(){



                const parametros  = {
                                        contacto:           this.form.contacto,
                                        estado:             this.form.estado,
                                        comentario:         this.form.comentario,
                                        terreno:            this.form.terreno,                                      
                                        telefono:           this.form.telefono,
                                        prefijo:            this.form.prefijo,
                                        numero:             this.form.numero,
                                        idc:                this.id,
                                        respuestasms:       this.form.respuestasms,
                                        repuestawhatsapp:   this.form.repuestawhatsapp,
                                        respuestaemail:     this.form.respuestaemail,
                                        mensajeenviado:     this.form.mensajeenviado,
                                        mensajerespuesta:   this.form.mensajerespuesta
                                        
                                    }
           
                this.form.contacto  = '';
                this.form.estado  = '';
                this.form.comentario  = '';
                this.form.terreno  = '';                                      
                this.form.telefono  = '';
                this.form.prefijo  = '';
                this.form.numero  = '';
                this.form.respuestasms  = '';
                this.form.repuestawhatsapp  = '';
                this.form.respuestaemail  = '';
                this.form.mensajeenviado  = '';
                this.form.mensajerespuesta  = '';  

                axios.post('gestionesAdd',parametros)
                .then(res => {
                    this.gestiones.push(res.data)
                     this.$swal('Gestión Creada con Exito');

                });

                  this.show=false
            },
            checkForm: function(){
                this.errors = [];
                if(!this.form.contacto){
                    this.errors.push('El contacto es Obligatorio');
                }
                if(!this.form.comentario){
                    this.errors.push('El comentario es Obligatorio');
                }
                
                if(!this.form.estado){
                    this.errors.push('Seleccione un estado');
                }
                  
                
                
                if(this.form.contacto && this.form.comentario && this.form.estado ){
                    this.agregar();
                }
            },
     }
}
</script>