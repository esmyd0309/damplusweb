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
                enableSorting="true"
                enableFilter="true"
                animateRows="true"
                pagination="true"
                rowSelection="multiple"
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
import EventBus from "../event-bus";
export default  {
    name: 'Gestiones',
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

        }
    },
    components: {
        AgGridVue
    },
    created(){
        EventBus.$emit('getdata', this.getDatagestiones);
        this.domLayout = "autoHeight";
        
    },
    beforeMount() {
        this.columnDefs = [
            {headerName: 'Fecha', field: 'fecha'},
            {headerName: 'Agente', field: 'agente'},
            {headerName: 'Estado', field: 'estado'},
            {headerName: 'Contacto', field: 'contacto'},
            {headerName: 'Telefono', field: 'telefono'},
            {headerName: 'Comentario', field: 'comentario'},
            {headerName: 'Posicion', field: 'posicion'},
            {headerName: 'Causa', field: 'causa'},
        ];
      

       
        fetch('http://damplus.estudiojuridicomedina.com/getgestiones/'+this.id)
            .then(result => result.json())
            .then(rowData => this.rowData = rowData);
    },
    getDatagestiones(){
      
        fetch('http://damplus.estudiojuridicomedina.com/getgestiones/'+this.id)
            .then(result => result.json())
            .then(rowData => this.rowData = rowData);
    }
}
</script>