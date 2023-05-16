<template>
	<div>
		<div class="container pt-5">
			<div class="form-group d-inline-flex col-12">
				<div class="col-2">
					<label for="order">Pedido</label>
					<select type="text" name="order" class="form-control" v-model="order">
						<option v-for="ord in orders" :value="ord.id">Pedido {{ ord.id }}</option>
					</select>
				</div>
				<div class="col-2">
					<label for="category_id">Producto</label>
					<select type="text" name="category_id" class="form-control" v-model="category_id">
						<option v-for="cat in root_categories" :value="cat.id">{{ cat.name }}</option>
					</select>
				</div>
				<div class="col-3" v-if="category_id">
					<label for="category_id">Categoría</label>
					<select type="text" name="category_id" class="form-control" v-model="subcategory_id">
						<option v-for="category in subcategories" :value="category.id">{{ category.name }}</option>
					</select>
				</div>
				<div class="col-3">
					<label for="category_id">Fecha Inicio</label>
					<input type="date" class="form-control" name="start_date">
				</div>
				<div class="col-3">
					<label for="category_id">Fecha Fin</label>
					<input type="date" class="form-control" name="final_date">
				</div>
				<div class="col-3">
					<br>
					<button id="boton" class="btn-primary btn" name="boton" @click="getItems()">Buscar</button>
					
				</div>
			</div>
			<div class="row">
				<h1>General</h1>
			<table class="table table-hover bg-light" v-if="items">
							<thead>
								<tr>
									<th scope="col">Producto</th>
									<th scope="col">Metros</th>
									<th scope="col">Precio</th>
									<th scope="col">Costo</th>
									<th scope="col">%</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Simple T
									</td>
									<td>
										{{ stsize }}
									</td>
									<td>
										{{ stotal }}
									</td>
									<td>
										{{ stcost }}
									</td>
									<td>
										<template v-if="stotal">
											{{  parseFloat(100 - (stcost * 100 / stotal)).toFixed(2) }}%
										</template>
									</td>
								</tr>
								<tr>
									<td>
										Doble T
									</td>
									<td>
										{{ dtsize }}
									</td>
									<td>
										{{ dtotal }}
									</td>
									<td>
										{{ dtcost }}
									</td>
									<td>
										<template v-if="dtotal">
											{{  parseFloat(100 - (dtcost * 100 / dtotal)).toFixed(2) }}%
										</template>
									</td>
								</tr>
								<tr>
									<td>
										Armada
									</td>
									<td>
										{{ asize }}
									</td>
									<td>
										{{ atotal }}
									</td>
									<td>
										{{ acost }}
									</td>
									<td>
										<template v-if="atotal">
											{{  parseFloat(100 - (acost * 100 / atotal)).toFixed(2) }}%
										</template>
									</td>
								</tr>
								<tr>
									<td>
										Placa
									</td>
									<td>
										{{ plsize }}
									</td>
									<td>
										{{ pltotal }}
									</td>
									<td>
										{{ plcost }}
									</td>
									<td>
										<template v-if="pltotal">
											{{  parseFloat(100 - (plcost * 100 / pltotal)).toFixed(2) }}%
										</template>
									</td>
								</tr>
								<tr>
									<td>
										Pergola
									</th>
									<td>
										{{ pesize }}
									</td>
									<td>
										{{ petotal }}
									</td>
									<td>
										{{ pecost }}
									</td>
									<td>
										<template v-if="petotal">
											{{  parseFloat(100 - (pecost * 100 / petotal)).toFixed(2) }}%
										</template>
									</td>
								</tr>
								<tr>
									<td>
										
									</th>
									<td>
										{{ pesize + plsize + asize + dtsize + stsize }}
									</td>
									<td>
										{{ monto }}
									</td>
									<td>
										{{ costo }}
									</td>
								</tr>
							</tbody>
						</table>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">Productos</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						
						<table class="table table-hover bg-light" v-if="items">
							<thead>
								<tr>
									<th scope="col">Producto</th>
									<th scope="col">Medida</th>
									<th scope="col">M/Total</th>
									<th scope="col">Cantidad</th>
									<th scope="col">€/m</th>
									<th scope="col">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr  v-for="item in items">
									<th scope="row">
										{{ item.title }}
									</th>
									<td>
										{{ item.size }}
									</td>
									<td>
										{{ item.size * item.qty }}
									</td>
									<td>
										{{ item.qty }}
									</td>
									<td>
										{{ (item.total / item.qty / item.size).toFixed(2)}} €
										
									</td>
									<td class="text-right">
										<strong>{{ item.total }} €</strong>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'

export default {
	props:['section'],
	mounted (){
		this.parent_categories();
		this.getItems();
		this.getOrders();
	},
	data: () => ({
		orders: null,
		order: 0,
		start_date: null,
		final_date: null,
		category_id: null,
		subcategory_id: null,
		items: null,
		root_categories: null,
		subcategories: null,
		stsize: 0,
		stotal: 0,
		stcost: 0,
		dtsize: 0,
		dtotal: 0,
		dtcost: 0,
		asize: 0,
		atotal: 0,
		acost: 0,
		plsize: 0,
		pltotal: 0,
		plcost: 0,
		pesize: 0,
		petotal: 0,
		pecost: 0,
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
		getItems(){
			let self = this
				axios.post('/api/items/stats/', {
					category_id: self.subcategory_id,
					start_date: self.start_date,
					final_date: self.final_date,
					order: self.order

				})
				.then(function (response) {
					self.items = response.data.data

					self.stsize = response.data.stmetros
					self.stotal = response.data.stotal
					self.stcost = response.data.stcost
					self.dtsize = response.data.dtmetros
					self.dtotal = response.data.dtotal
					self.dtcost = response.data.dtcost
					self.asize = response.data.ametros
					self.atotal = response.data.atotal
					self.acost = response.data.acost
					self.plsize = response.data.plmetros
					self.pltotal = response.data.pltotal
					self.plcost = response.data.plcost
					self.pesize = response.data.pemetros
					self.petotal = response.data.petotal
					self.pecost = response.data.pecost
				})
				.catch(function (error) {
					console.log(error);
				});
			
		},
		parent_categories(){
			let self = this
			axios.get('/api/categories/list/0', {
			})
			.then(function (response) {
				self.root_categories = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		children_categories(){
			let self = this
			axios.get('/api/categories/list/'+self.category_id, {
			})
			.then(function (response) {
				self.subcategories = response.data
				self.subcategory_id = response.data[0].id
			})
			.catch(function (error) {
				console.log(error);
			});
		},
	},
	watch:{
		category_id: function(){
			this.children_categories();
		},
	},
	computed:{
		costo: function(){
			return parseFloat( this.pecost + this.plcost + this.acost + this.dtcost + this.stcost).toFixed(2)
											 
		},
		monto: function(){
			return parseFloat( this.petotal + this.pltotal + this.atotal + this.dtotal + this.stotal).toFixed(2)
											 
		}
	}
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
