<template>
   <div>
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
        v-model="modalcompromiso"  
        id="modal-xl" 
        size="xl" 
        title="Gestion de Compromiso"
    >
    
        
        <b-card no-body class="overflow-hidden" >
            <b-row no-gutters v-for="(item, index) in showinfo" :key="index">
                <b-col md="6">
                    <b-card border-variant="primary" header="Estado de la Gestion" header-bg-variant="primary" header-text-variant="white" align="left" >
                        <b-card-text >
                            <p>El cliete se comprometio a cancelar el valor de <strong>${{item.valor}}</strong>, para la fecha 
                                <strong>{{item.fechapago}}</strong> con una forma de pago  de <strong>{{item.formapago}}</strong>
                            </p>
                            <p>El contacto se realizo via {{item.contacto}} 
                                <i v-if="item.contacto !='EMAIL'"> al numero {{item.telefono}}</i>  
                                <i v-else>{{item.email}}</i> 
                            </p>
                            <p><strong>Observaciones: </strong> {{item.comentario}}</p>
                        </b-card-text>
                    </b-card>
                </b-col>
                <b-col md="6">
                    <b-card border-variant="light" header="Detalle de La Gestion" header-bg-variant="light" >
                        <strong>Fecha Registro: </strong>{{item.fecha}}<br/>
                        <strong>Tipo Compromiso: </strong>{{item.tipocompromiso}}<br/>
                        <strong>Tipo Contacto: </strong>{{item.tipocontacto}}<br/>
                        <strong>Contacto: </strong>{{item.contacto}}<br/>
                        <strong>Estado: </strong>{{item.estado}}<br/>
                        <strong>Asesor: </strong>{{item.agente}}<br/>
                    </b-card>

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
    name: 'compromisos',
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
            getRowHeight: null,
            showinfo: null,
            modalcompromiso: false
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
            {headerName: 'Registrado', field: 'fecha'},
            {headerName: 'Fecha Pago', field: 'fechapago'},
            {headerName: 'Valor', field: 'valor'},
            {headerName: 'Tipo Compromiso', field: 'tipocompromiso'},
            {headerName: 'Agente', field: 'agente'},
            {headerName: 'Estado', field: 'estado'},
            {headerName: 'Tipo Contacto', field: 'tipocontacto'},
            {headerName: 'Telefono', field: 'telefono',editable: true},
            {headerName: 'Comentario', field: 'comentario', editable: true,
}
        ];
      this.defaultColDef = {
      flex: 1,
      cellClass: 'cell-wrap-text',
      autoHeight: true,
      sortable: true,
      resizable: true,
    }

       
        fetch('http://damplus.estudiojuridicomedina.com/getcompromisos/'+this.id)
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
            });
            this.showinfo = selectedRows
            if (selectedRows.length > maxToShow) {
                var othersCount = selectedRows.length - maxToShow;
                selectedRowsString +=
                ' and ' + othersCount + ' other' + (othersCount !== 1 ? 's' : '');
            }
            document.querySelector('#selectedRows').innerHTML = selectedRowsString;
            this.modalcompromiso=true
            console.log(selectedRows)
        },
    }
}
</script>