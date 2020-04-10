<template>
   <div>
       
    <b-alert
      :show="dismissCountDown"
      dismissible
      variant="warning"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged"
    >
      <strong>Para ver el detalle de cada registro, ejecute doble click  {{ dismissCountDown }} segundos...</strong> 
    </b-alert>
    <div class="test-header" hidden>
        Selecionado:
        <span id="selectedRows" ></span>
    </div>
    <ag-grid-vue 
            style="width: 100%; height: 100%;"
            class="ag-theme-blue"
            id="myGrid"
            :gridOptions="gridOptions"
            :columnDefs="columnDefs"
            :rowData="rowData"
            :domLayout="domLayout"
            :modules="modules" 
            :rowDragManaged="true"
            :enableColResize="true"
            :defaultColDef="defaultColDef"
            enableSorting="true"
            enableFilter="true"
            animateRows="true"
            pagination="true"
            rowSelection="multiple"
            @selection-changed="onSelectionChanged"
    >
    </ag-grid-vue>

    <b-modal 
        v-model="show"  
        id="modal-xl" 
        size="xl" 
        title="Gestion de Recaudación"
    >
    
        
        <b-card no-body class="overflow-hidden" >
            <b-row no-gutters>
                
            <b-col md="8" v-if="!showarchivo">
                <div v-if="success != ''" class="alert alert-success" role="alert">
                   <center>{{success}}</center>
                </div>

                <form @submit="formSubmit" enctype="multipart/form-data">
                    <b-form-file
                        v-model="file"
                        placeholder="Subir la Imagen..."
                        v-on:change="onFileChange"
                    ></b-form-file>
                    <div class="col-md-3" v-if="image">
                        <img :src="image" class="img-responsive">
                    </div>
                    <b-button type="submit"  class="mt-3" variant="outline-success" block >Cargar Recibo</b-button>
                </form>
            </b-col>
            <b-col md="8" v-else>
                
                <b-card-img :src="showarchivo" class="rounded-0"></b-card-img>
                
            </b-col>
            <b-col md="4">
                <b-card-body title="Detalle de la Recaudación">
                <b-card-text v-for="(item, index) in showDocumento" :key="index"><br/>
                    <strong>Documento: </strong> {{item.documento}} <br/>
                    <strong>Fecha De Pago: </strong> {{item.fechapago}}<br/>
                    <strong>Forma de Pago:</strong> {{item.formapago}}<br/>
                    <strong>Valor: </strong> {{item.valor}}<br/>
                    <strong>Banco Origen: </strong> {{item.origen}}<br/>
                    <strong>Banco Destino: </strong> {{item.destino}}<br/>
                   <strong>Comentario: </strong> {{item.comentario}}<br/>
                    <strong>Nombre Archivo: </strong> {{item.nombreArchivo}}<br/>

                </b-card-text>
                </b-card-body>
            </b-col>
            </b-row>
        </b-card>

    </b-modal>


   </div>
</template>

<script>
import axios from 'axios'
import "ag-grid-community/dist/styles/ag-grid.css";
import "ag-grid-community/dist/styles/ag-theme-balham.css";
import { AgGridVue } from 'ag-grid-vue';
import { AllCommunityModules } from "@ag-grid-community/all-modules";

export default  {
    name: 'recaudaciones',
    props: {
        id: {
        default: 1
        },
        cedula: {
        default: 1
        }
    },
    data() {
        return {
            columnDefs: null,
            rowData: null,
            domLayout: null,
            modules: AllCommunityModules,            
            defaultColDef: null,
            gridApi: null,
            show: false,
            showDocumento: '',
            showarchivo: null,
            dismissSecs: 10,
            dismissCountDown: 0,
            enlace: 'http://damplus.estudiojuridicomedina.com/',
            file: '',
            success: '',
            image: '',
            idc: null

        }
    },
    components: {
        AgGridVue
    },
    created(){
     
        this.domLayout = "autoHeight";
        
    },
    beforeMount() {
        this.showAlert()
        this.gridOptions = {};

        this.columnDefs = [
            {headerName: 'Id', field: 'id'},
            {headerName: 'Registrado', field: 'fecha'},
            {headerName: 'Agente', field: 'agente'},
            {headerName: 'Documento', field: 'documento'},
            {headerName: 'Forma Pago', field: 'formapago'},
            {headerName: 'Feha Pago', field: 'fechapago'},
            {headerName: 'Valor', field: 'valor'},
            {headerName: 'Banco Origen', field: 'origen'},
            {headerName: 'Banco Destino', field: 'destino'},
            {headerName: 'Comentario', field: 'comentario',editable: true},
            {headerName: 'Archivo', field: 'archivo'},            
            {headerName: 'Nombre Archivo', field: 'nombreArchivo'},
            {headerName: 'Cargado Archivo', field: 'agenteRecibo'},
            {headerName: 'fecha Archivo', field: 'fechaRecibo'},



        ];
        this.defaultColDef = {
            //flex: 1,
            cellClass: 'cell-wrap-text',
            autoHeight: true,
            sortable: true,
            resizable: true,
        }

       
        fetch('http://damplus.estudiojuridicomedina.com/getrecaudaciones/'+this.id)
            .then(result => result.json())
            .then(rowData => this.rowData = rowData);
    },
    mounted() {
        this.gridApi = this.gridOptions.api;
        this.gridColumnApi = this.gridOptions.columnApi;

    },
    methods: {
        countDownChanged(dismissCountDown) {
            this.dismissCountDown = dismissCountDown
        },
        showAlert() {
            this.dismissCountDown = this.dismissSecs
        },
        onSelectionChanged() {
            var selectedRows = this.gridApi.getSelectedRows();
            var selectedRowsString = '';
            var maxToShow = 155;
            selectedRows.forEach(function(selectedRow, index) {
                if (index >= maxToShow) {
                return;
                }
                if (index > 0) {
                selectedRowsString += ', ';
                }
                selectedRowsString += selectedRow.archivo;


            });
            if(selectedRowsString!='null'){
                this.showarchivo = "http://damplus.estudiojuridicomedina.com/"+selectedRowsString
            }
            this.showDocumento = selectedRows

            if (selectedRows.length > maxToShow) {
                var othersCount = selectedRows.length - maxToShow;
                selectedRowsString +=
                ' and ' + othersCount + ' other' + (othersCount !== 1 ? 's' : '');
            }
            document.querySelector('#selectedRows').innerHTML = selectedRowsString;
            selectedRows.forEach(element => {
                this.idc = element.id;

            });
            this.show=true
        },

        onFileChange(e){
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('id',this.idc);
            

            axios.post(this.enlace+'addrecibo', formData, config)
            .then(function (response) {
                currentObj.success = response.data.success;
            })
            .catch(function (error) {
                currentObj.output = error;
            });
            this.dismissCountDown=false
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
}
</script>