<template>
	<div>
		<div class="container pt-5">
			<div class="panel panel-default">
				<div class="panel-heading">Pedidos</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<v-client-table :columns="columns" :data="orders" :options="options" :theme="theme" id="dataTable" md="12" lg="12" sm="12">
				            <template slot="uuid" slot-scope="props">
				              <router-link :to="{ path: '/admin/agreements/edit/'+props.row.uuid }">
				                <i class="fa fa-pencil"></i>
				              </router-link>
				            </template>
				            <template slot="total" slot-scope="props">
				            	<template v-if="props.row.ship">
				            		{{ Math.round(props.row.total * (props.row.delivery_comission/100 + 1)) + parseFloat(props.row.ship_extra)  }} €
				            	</template>
				            	<template v-else>
				            		{{ Math.round(props.row.total)  + parseFloat(props.row.ship_extra) }} €
				            		
				            	</template>
				            	
				            </template>
				            <template slot="presupuesto" slot-scope="props">
				            	<a :href="'/order/presupuesto/'+props.row.id">Descargar</a>
				            </template>
				            <template slot="actions" slot-scope="props">
				            	<router-link :to="'/order/' + props.row.id">
									<i class="fas fa-edit"></i>
								</router-link>
								<span @click="processOrder(props.row.id)">
									<i class="fas fa-file"></i>
								</span>
								<span @click="invoiceOrder(props.row.id)">
									<i class="fas fa-file-alt"></i>
								</span>
				            </template>
				            <template slot="solicitud" slot-scope="props">
								<a :href="'/order/pedido/'+props.row.id" v-if="props.row.solicitud">{{ String(props.row.solicitud).padStart(6,0) }}</a>

				            </template>
				            <template slot="albaran" slot-scope="props">
								<a :href="'/order/albaran/'+props.row.id" v-if="props.row.albaran">{{ String(props.row.albaran).padStart(6,0) }}</a>
				            	
				            </template>
				            <template slot="factura" slot-scope="props">
								<a :href="'/order/invoice/'+props.row.id" v-if="props.row.factura">{{ String(props.row.factura).padStart(6,0) }}</a>

				            </template>
				            <template slot="borrar" slot-scope="props">
								<a  @click="remove(props.row.id)" >Borrar</a>
				            </template>
				         </v-client-table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import swal from 'sweetalert2'
import {ClientTable, Event} from 'vue-tables-2'
import Vue from 'vue'

Vue.use(ClientTable)

export default {
	props:['section'],
	mounted (){
		this.getOrders();
	},
	data: () => ({
		orders: null,
		columns: ['id', 'razon', 'address','status','total','actions','presupuesto','solicitud','albaran','factura','borrar'],
	     options: {
	        headings: {
	          uuid: {
	            text: '',
	            id: 'fit'
	          } ,
	          code: 'Código',
	          name: 'Nombre',
	        },
	        sortable: ['id', 'status','total','razon'],
	        filterable: ['razon', 'status','name','surname','address','city','NIF','pc'],
	        sortIcon: { base:'fa', up:'fa-sort-asc', down:'fa-sort-desc', is:'fa-sort' },
	        texts: null,
	        pagination: {
	          chunk: 5,
	          edge: true,
	          nav: 'scroll'
	        },
	        texts: {
	            count:"Mostrando desde {from} a {to} de {count} registros|{count} registros|1 registro",
	            filterPlaceholder:"Buscar",
	            filter:"Filtro:",
	            first:'Primero',
	            last:'Último',
	            limit:"Registros:",
	            page:"Página:",
	            noResults:"Sin registros coincidentes",
	            filterBy:"Filtro por {column}",
	            loading:'Cargando...',
	            defaultOption:'Seleccionar {column}',
	            columns:'Columna'
	         },
	     },
	      useVuex: false,
	      theme: 'bootstrap4',
	      template: 'default',
	}),
	methods:{
		getOrders(){
			let self = this
			axios.get('/api/orders', {
			})
			.then(function (response) {
				self.orders = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		processOrder(id){
			let self = this
			axios.get('/api/order/process/' + id, {
			})
			.then(function (response) {
				self.orders = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		invoiceOrder(id){
			let self = this
			axios.get('/api/order/invoice/' + id, {
			})
			.then(function (response) {
				self.orders = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		remove(id){
			let self = this
			swal({
  				title: '¿Estás seguro?',
				text: "¡La operación no se podrá revertir!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '¡Sí, elimínalo!'
			}).then((result) => {
  				if (result.value) {
    				axios.post('/api/order/remove/' + id, {
				})
				.then(function (response) {
					self.getOrders();
					swal(
	      					'¡Borrado!',
	    					'Orden eliminada.',
	      					'success'
	    				)
				})
				.catch(function (error) {
					console.log(error);
				});
  				}
			})
			
		},
	}
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
