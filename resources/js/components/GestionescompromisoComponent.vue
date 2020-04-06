<template>
   <div>
        <ag-grid-vue 
                style="width: 100%; height: 100%;"
                class="ag-theme-blue"
                id="myGrid"
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
                @column-resized="onColumnResized"
                :gridOptions="gridOptions"
                @grid-ready="onGridReady"
        >
    </ag-grid-vue>
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
            defaultColDef: null,
            gridOptions: null,
            gridApi: null

        }
    },
    components: {
        AgGridVue
    },
    created(){
     
        this.domLayout = "autoHeight";
        
    },
    beforeMount() {
         this.gridOptions = {};
        this.columnDefs = [
            {headerName: 'Registrado', field: 'fecha'},
            {headerName: 'Fecha Pago', field: 'fechapago'},
            {headerName: 'Valor', field: 'valor'},
            {headerName: 'Tipo Compromiso', field: 'tipocompromiso'},
            {headerName: 'Agente', field: 'agente'},
            {headerName: 'Estado', field: 'estado'},
            {headerName: 'Contacto', field: 'contacto'},
            {headerName: 'Telefono', field: 'telefono'},
            {headerName: 'Comentario', field: 'comentario'},
            
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
    onColumnResized(params) {
      params.api.resetRowHeights();
    },
    onGridReady(params) {
      setTimeout(function() {
        params.api.setRowData(createRowData());
      }, 500);
    },
  },
}
</script>