<template>
	<div>
		<nav class="w-100">
			<div class="text-center">
				<img src="https://hiforcem.com/truck.png" width="56px" class="flex">
				Peso: {{ weight }} KG
				<button class="btn btn-primary" @click="getWeights()"><i class="fas fa-sync-alt"></i></button>
			</div>
			
		</nav>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">Editar Envío</div>
				<div class="panel-body">
					<div class="card-body bg-white">

						<div class="form-group form-inline">
							<span @click="shipData.order1=0">
								<i class="fas fa-minus-circle" style="color: red;"></i>
							</span>
							<select name="order1" v-model="shipData.order1" class=" mr-3 pr-0">
								<option v-for="order in orders" :value="order.id">{{ order.razon }} - Pedido {{ order.id }}</option>
							</select>
							

							<span @click="shipData.order2=0">
								<i class="fas fa-minus-circle" style="color: red;"></i>
							</span>
							<select name="order2" v-model="shipData.order2" class=" mr-3">
								<option v-for="order in orders" :value="order.id">{{ order.razon }} - Pedido {{ order.id }}</option>
							</select>


							<span @click="shipData.order3=0">
								<i class="fas fa-minus-circle" style="color: red;"></i>
							</span>
							<select name="order3" v-model="shipData.order3" class=" mr-3">
								<option v-for="order in orders" :value="order.id">{{ order.razon }} - Pedido {{ order.id }}</option>
							</select>

							<span @click="shipData.order4=0">
								<i class="fas fa-minus-circle" style="color: red;"></i>
							</span>
							<select name="order4" v-model="shipData.order4" class=" mr-3">
								<option v-for="order in orders" :value="order.id">{{ order.razon }} - Pedido {{ order.id }}</option>
							</select>
						</div>
						<div class="form-group form-inline">
							<select name="weights" v-model="shipData.weights" class=" mr-3 pr-0 form-control">
								<option value="15000">15000</option>
								<option value="25000">25000</option>
							</select>
						
							<input type="text" name="weight" class="form-control" v-model="shipData.weight" disabled="">
							<input type="text" name="transporter" class="form-control" v-model="shipData.transporter" placeholder="Transportista">
							<input type="text" name="remolque" class="form-control" v-model="shipData.remolque" placeholder="Remolque">
							<input type="text" name="matricula" class="form-control" v-model="shipData.matricula" placeholder="Matricula">
							<input type="text" name="shipping_cost" class="form-control" v-model="shipData.shipping_cost" placeholder="Portes/Cliente">

							<select name="status" v-model="shipData.status" class=" mr-3 pr-0 form-control">
								<option value="Vacio">Vacio</option>
								<option value="Incompleto">Incompleto</option>
								<option value="Completo">Completo</option>
							</select>
							<button class="btn btn-primary" @click="storeShip()">Guardar</button>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="row w-100 mx-1">
				<order class="col-4" :orderNumber="shipData.order1" editShip="1" v-if="shipData.order1"></order>
				<order class="col-4" :orderNumber="shipData.order2" editShip="1" v-if="shipData.order2"></order>
				<order class="col-4" :orderNumber="shipData.order3" editShip="1" v-if="shipData.order3"></order>
			
			</div>
			<div class="row w-100 mt-3">
				<order class="col-4" :orderNumber="shipData.order4" editShip="1" v-if="shipData.order4"></order>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'
import editOrder from './editOrder.vue'

export default {
	components:{
		order: editOrder
	},
	mounted (){
		if(this.$route.params.id){
			this.ship = parseInt(this.$route.params.id)
		}
		this.getShip()
		this.getOrders()
	},
	data: () => ({
		shipData: {
			id:0,
			weight: 0,
			weights: 15000,
			transporter: "",
			remolque: "",
			matricula: "",
			shipping_cost: "",
			status: '',
			order1: 0,
			order2: 0,
			order3: 0,
			order4: 0,
		},
		weight: 0,

		orders: null,
		
	}),
	methods:{
		getShip(){
			let self = this
			axios.get('/api/ship/number/'+this.ship, {
			})
			.then(function (response) {
				self.shipData = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},

		
		getOrders(){
			let self = this
			axios.get('/api/ordersIndex', {
			})
			.then(function (response) {
				self.orders = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},

		
		storeShip(){
			let self = this

			axios.post('/api/ship/update/'+this.ship,this.shipData)
			.then(function (response) {
				self.$toast.open({
                    message: 'Guardado con éxito', type: 'is-success'
                })
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		
		getWeights(){
			let self = this

			axios.post('/api/ships/getWeights',{
				order1: self.shipData.order1,
				order2: self.shipData.order2,
				order3: self.shipData.order3,
				order4: self.shipData.order4,
			})
			.then(function (response) {
				self.weight = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		
	},
	watch:{
		
	}
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
