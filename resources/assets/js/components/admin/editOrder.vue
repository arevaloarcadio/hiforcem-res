<template>
	<div>
		<nav class="navbar navbar-light navbar-expand-lg pt-0 pb-0" style="background-color: #3c4b64;color: #fff !important">
  			<ul class="navbar-nav mr-auto mt-2">
				<template v-for="category in root_categories">
					<li class="nav-item">
						<a href="#" class="nav-link font-weight-bold mr-4" 
						:class="{ active : (category_id === category.id)}"
						@click="selectCategory(category.id)">{{ category.name }}
						</a>
						
					</li>
				</template>
			</ul>
		</nav>
		<div>
			<div class="card bg-light mb-3 pt-3" v-if="category_id">
				<div class="row justify-content-md-center form-group form-inline mb-3" v-if="category_id">
						<label for="subcategory" v-if="categories && categories.length > 1">Tipo:  </label>
						<select name="subcategory" v-model="subcategory_id" class="form-control mr-3" v-if="categories && categories.length > 1">
							<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
						</select>
						<div class="form-inline" v-show="selected_category.options && selected_category.options.length > 0">
							<template v-for="option in selected_category.options" class="form-inline">
								<label for="option">{{ option.question }} </label>
								<select :name="'option_'+option.id"  class="form-control mr-3" @change="updImage(option.id,option.question,$event.target.value)">
									<option v-for="value in option.values" :value="value.value">{{ value.value }}</option>
								</select>
							</template>
						</div>
						<label for="qty">Cantidad: </label>
						<input type="number" name="qty" id="qty" v-model="qty" class="form-control mr-3 col-md-1">
						<label for="size">Medida: </label>
						<input type="number" step=".01" name="size" id="size" v-model="size" class="form-control mr-3 col-md-1" @keydown.enter="get_products_by_size">
						
						<button @click="get_products_by_size" class="form-control btn-primary" :disabled="!size || !subcategory_id || !qty">+</button>
				</div>
				
			</div>

			<div class="card bg-light" v-if="items">
				<div class="row p-1">	
					<div class="col">
						<h4><strong>Pedido </strong><template v-if="order"> Nº {{ order }} - Razón: {{ orderData.razon }}</template> </h4>
					</div>
					<div class="col">

					</div>
					<div class="col">
						<img src="truck.png" width="56px" class="flex">
						Peso: {{ weight }} Kg
					</div>
				</div>
			</div>
			<div class="card-body bg-white">
				<table class="table table-hover bg-light" v-if="items">
					<thead>
						<tr>
							<th scope="col">Producto</th>
							<th scope="col">Mts</th>
							<th scope="col">M/T</th>
							<th scope="col">Uds</th>
							<th scope="col" v-if="editShip != 1">€/m</th>
							<th scope="col" class="text-right" v-if="editShip != 1">Precio</th>
							<th scope="col" class="text-right" v-if="editShip != 1">Opciones</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<template  v-for="item in items">
							<tr>
								<th scope="row" >
									<template v-if="order">
										<select name="item_product_id" v-model="item.product_id" class="form-control mr-3" @change="updateProduct(item.id,$event.target.value)">
											<option v-for="item_product in products[item.category_id]" :value="item_product.id">{{ item.category.name + " -> " + item_product.title }}</option>
										</select>

									</template>
									<template v-else>
										{{ item.title }}
									</template>
								</th>
								<td>
									{{ item.size }}
								</td>
								<td>
									{{ (item.size * item.qty).toFixed(2) }}
								</td>
								<td>
									<input type="number" name="qty" :value="item.qty" @blur="updateQty(item.id,$event.target.value)" class="form-control col-md-3">
								</td>
								<td v-if="editShip != 1">
									<template v-if="!order">
										{{ (item.total / item.qty / item.size).toFixed(2)}} €
									</template>
									<template v-else>
										<template v-if="orderData.ship == 1">
											<input type="number" step="0.01" name="PM" :value="(item.totalEnvio / item.qty / item.size).toFixed(2)"  @change="updatePM(item.id,$event.target.value,true)" class="form-control col-md-4">
										</template>
										<template v-else>
											<input type="number" step="0.01" name="PM" @change="updatePM(item.id,$event.target.value,true)"  :value="(item.total / item.qty / item.size).toFixed(2)"  class="form-control col-md-4">
										</template>
									</template>
								</td>
								<td class="text-right" v-if="editShip != 1">
									<template v-if="orderData.ship == 1">
										<strong>{{ (item.total * 1.05).toFixed(2) }} €</strong>
									</template>
									<template v-if="orderData.ship == 0">
										<strong>{{ item.total }} €</strong>
									</template>
								</td>
								<td class="text-right" v-if="editShip != 1">
									<template v-for="option in JSON.parse(item.options)">
										<strong>{{ option.question }}:</strong> {{ option.value}}<br>
									</template>
								</td>
								<td>
									<a href="#" @click="removeItem(item.id)">
										<i class="fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
						</template>
						
					</tbody>
				</table>
			</div>
		</div>
		<div style="    margin-left: 46px;">
			<div class="row">
				<div class="form-group">
					<label for="palos" class="col-md-4">Palos</label>
					<input type="text" name="palos" v-model="orderData.palos" class="form-control">
				</div>
				<div class="form-group">
					<label for="ship_extra">Importe Palos</label>
					<input type="number" step="0.01" name="ship_extra" v-model="(orderData.palos * 1.40).toFixed(2)" class="form-control">
				</div>
				<div class="form-group">
					<label for="obra" class="col-md-4">Obra</label>
					<input type="text" name="obra" v-model="orderData.obra" class="form-control">
				</div>
				<div class="form-group">
					<label for="date" class="col-md-4">Fecha</label>
					<input type="date" name="date" v-model="orderData.date" class="form-control">
				</div>
				
				<div class="form-group">
					<label for="comment" class="col-md-4">Comentario</label>
					<textarea name="comment" v-model="orderData.comment" class="form-control" rows="4" cols="50">{{ orderData.comment }}</textarea>
				</div>
				<div class="form-group">
					<label for="ship_extra">Aporte Extra</label>
					<input type="number" step="0.01" name="ship_extra" v-model="orderData.ship_extra" class="form-control">
				</div>
				
			</div>	
		</div>
		<div>
			<div class="row">
				
				<div class="card bg-light w-100 flex text-right p-3 mb-5">
					<div v-if="orderData.ship == 1">
						<h1><strong>Total: {{ parseFloat(shipPrice)+parseFloat(orderData.ship_extra) }} €</strong></h1>
					</div>
					<div v-else>
						<h1><strong>Total: {{ parseFloat(totalPrice)+parseFloat(orderData.ship_extra) }} €</strong></h1>
					</div>
				</div>
			</div>
		</div>

		<div class=" w-100">

			<div class="row col-8 offset-2">
				<div class="form-inline w-100 justify-content-center">
					<label for="ship">Recogida</label>
					<input type="radio" id="ship" value="0" v-model="orderData.ship" class="mr-5">
					<label for="ship">Envío</label>
					<input type="radio" id="ship" value="1" v-model="orderData.ship">
				</div>
				
				<div>
					<div class="panel panel-default">
						<div class="panel-body w-100 pt-3" v-show="orderData.ship">
							<div class="form-group row">
								<label for="name" class="col-md-4">Nombre</label>
								<input type="text" name="name" v-model="orderData.name" class="form-control col-md-8">
							</div>
							<div class="form-group row">
								<label for="surname" class="col-md-4">Apellidos</label>
								<input type="text" name="surname" v-model="orderData.surname" class="form-control col-md-8">
							</div>
							<div class="form-group row">
								<label for="razon" class="col-md-4">Razón Social</label>
								<input type="text" name="razon" v-model="orderData.razon" class="form-control col-md-8">
							</div>			
							<div class="form-group row">
								<label for="address" class="col-md-4">Dirección</label>
								<input type="text" name="address" v-model="orderData.address" class="form-control col-md-8">
							</div>
							<div class="form-group row">
								<label for="city" class="col-md-4">Ciudad</label>
								<input type="text" name="city" v-model="orderData.city" class="form-control col-md-8">
							</div>
							<div class="form-group row">
								<label for="pc" class="col-md-4">Código Postal</label>
								<input type="text" name="pc" v-model="orderData.pc" class="form-control col-md-8">
							</div>
							<div class="form-group row">
								<label for="province" class="col-md-4">Provincia</label>
								<input type="text" name="province" v-model="orderData.province" class="form-control col-md-8">
							</div>
						</div>
						<div class="panel-footer">
							<div class="form-group row">
								<button @click="store()" class="form-control btn-primary" :disabled="!items && !items.length"> Tramitar pedido</button>
								<br>
							</div>
						</div>
					</div>
				</div>
				<hr>
				
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

export default {
	props:['category','orderNumber','editShip'],
	mounted (){
		console.log("------------editOrder------------")
		if(this.$route.params.id && !this.orderNumber){
			this.order = parseInt(this.$route.params.id)
		}
		if(this.orderNumber){
			this.order = parseInt(this.orderNumber)
			console.log(this.order)
		}
		this.parent_categories()
		if(this.order){
			this.getOrder()
			this.get_orderCart()
	
		}else{
			this.get_cart()
		}
		this.products = this.getAllProducts()
		this.qty = 10

	},
	data: () => ({
		products: null,
		category_id: null,
		subcategory_id: null,
		root_categories: null,
		selected_category: null,
		categories: null,
		products: null,
		order: 0,
		optionSelected: null,
		optionValue: {
			id:0,
			value: '',
			question: ''
		},
		it_cat: null,
		dropFiles: null,
		items: null,
		max_size: null,
		qty: 0,
		cart: null,
		size: null,
		weight: 0,
		totalPrice: 0,
		shipPrice: 0,
		tmpQty: 0,
		imageSelected: null,
		item_actual:null,
		contador: 0,
		//form
		orderData: {
			ship: false,
			address: '',
			name: '',
			surname: '',
			razon: '',
			city: '',
			pc: '',
			province: '',
			palos: '',
			comment: '',
			obra: '',
			date: '',
			delivery_comission: 0,
		},
	}),
	methods:{
		printear(){
			console.log("---")
			return 1;
		},
		getOrder(){
			let self = this
			axios.get('/api/order/number/'+this.order, {
			})
			.then(function (response) {
				self.orderData = response.data

				console.log(this.orderData,"get Order")
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
		async item_categories(id){
			let self = this
			var ret;
			const resp = await axios.get('/api/products/list/'+id)
			resp.data.forEach(function(element){
				element.category = ""
			})
			console.log(resp.data)
			return resp.data;
		},
		children_categories(){
			let self = this
			axios.get('/api/categories/list/'+self.category_id, {
			})
			.then(function (response) {
				response.data.forEach(function(element) {
  					element.options.forEach(function(option){
  						option.values = JSON.parse(option.values)
  					})
				});
				self.categories = response.data
				self.subcategory_id = response.data[0].id
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		get_products(){
			let self = this
			axios.get('/api/products/list/'+self.subcategory_id, {
			})
			.then(function (response) {
				self.products = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		getAllProducts(){
			let self = this
			axios.get('/api/product/all', {
			})
			.then(function (response) {
				self.products = response.data
				console.log(response.data,"----a")
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		get_products_by_size(){
			let self = this
			axios.post('/api/products/size/'+self.subcategory_id+'/'+self.size+'/'+self.qty + '/' + self.order + '/0'  , {
				options: JSON.stringify(this.optionValue)
			})
			.then(function (response) {
				self.$toast.open({
                    message: 'Agregado con éxito',
                    type: 'is-success'
                })
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
				self.size = ''
				self.qty = 10
				if(self.order){
					self.get_orderCart()
					self.getOrder()
				}else{
					self.get_cart()
				}
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		store(){
			let self = this

			axios.post('/api/order/update/'+this.order,{
				id: this.orderData.id,
				name: this.orderData.name,
				surname: this.orderData.surname,
				address: this.orderData.address,
				razon: this.orderData.razon,
				NIF: this.orderData.NIF,
				city: this.orderData.city,
				pc: this.orderData.pc,
				province: this.orderData.province,
				comment: this.orderData.comment,
				total: this.orderData.totalPrice,
				delivery_comission: this.orderData.delivery_comission,
				palos: this.orderData.palos,
				razon: this.orderData.razon,
				obra: this.orderData.obra,
				date: this.orderData.date,
				ship: this.orderData.ship,
				ship_extra: this.orderData.ship_extra,
				status: this.orderData.status,
			})
			.then(function (response) {
				console.log("-------------f")
				self.$router.push({ path: '/orders'})
				self.$toast.open({
                    message: 'Actualizado con éxito',
                    type: 'is-success'
                })
                $('#address-form').modal('hide')
				self.shipPrice = 0
                self.get_orderCart()
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		get_cart(){
			let self = this
			axios.get('/api/items/', {
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
				
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		get_orderCart(){
			let self = this
			axios.get('/api/items/order/'+this.order, {
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
			console.log('get')

				if(self.orderData.ship){
					self.shipPrice = (self.totalPrice * (self.orderData.delivery_comission/100 + 1)).toFixed(2)
				}else{
					self.shipPrice = self.totalPrice
				}
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		removeItem(id){
			let self = this
			axios.post('/api/items/delete/'+id, {
				order: self.order
			})
			.then(function (response) {
				swal(
					'Realizado!',
					'Producto eliminado con éxito!',
					'success'
					)
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
				if(self.order){
					self.get_orderCart()
					self.getOrder()
				}else{
					self.get_cart()
				}
			})
			.catch(function (error) {
				swal(
					'Error!',
					'Ningún producto coincide con las medidas aportadas!',
					'success'
					)
				console.log(error);
			});
		},
		updateQty(id,qty){
			let self = this
			axios.post('/api/items/edit/'+id, {
				qty: qty,
				order: self.order
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)

			})
			.catch(function (error) {
				swal(
					'Error!',
					'No se puedo actualizar la cantidad!',
					'success'
					)
				console.log(error);
			});
		},
		updateProduct(id,product){
			let self = this
			axios.post('/api/items/edit/'+id, {
				product_id: product,
				order: self.order
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)

				self.$toast.open({
                    message: 'Actualizado con éxito',
                    type: 'is-success'
                })
			})
			.catch(function (error) {
				swal(
					'Error!',
					'No se puedo actualizar la cantidad!',
					'success'
					)
				console.log(error);
			});
		},
		updatePM(id,PM,remove_discount = false){
		
			let self = this
			axios.post('/api/items/edit/'+id, {
				PM: PM,
				qty: 0,
				order: self.order,
				remove_discount: remove_discount
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
			})
			.catch(function (error) {
				swal(
					'Error!',
					'No se puedo actualizar la cantidad!',
					'success'
					)
				console.log(error);
			});
		},
		total(size,qty,price){
			var sum = size * qty * price
			if(sum){
				return (sum.toFixed(2))
			}else{
				return (0)
			}
		},
		addToCart(size,qty,price){
			var sum = size * qty * price
			console.log(sum)
		},
		selectCategory(id){
			this.category_id = id
		},
		form(){
			$('#address-form').modal('show')
		},
		updImage(id,question,value){
			this.optionValue.find(o => o.id === id).value = value
		}
	},
	watch:{
		category_id: function(){
			this.children_categories();
		},
		subcategory_id: function(){
			this.selected_category = this.categories.find(o => o.id === this.subcategory_id)
			this.optionValue = this.selected_category.options
			this.optionValue.map(function(element){
				element.value = element.values[0].value
			});
		},
		optionSelected: function(){
			this.selected_category = this.categories.find(o => o.id === this.optionSelected)
			this.optionValue = this.selected_category.options
		},
		category: function(){
			console.log(this.category)
		},
		orderNumber: function(){
			//console.log("--"+this.orderNumber)
			this.order = this.orderNumber
			if(this.order){
				this.get_orderCart()
				this.getOrder()
			}else{
				this.get_cart()
			}
		},
		'orderData.ship': function(prev,actual){
			if(prev != 0)
			{
				//this.store()
			}
			
		}
	}
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
<style >

.navbar-light .navbar-nav .nav-link{
color: 	rgba(255, 255, 255, 0.75) !important;
}
</style>


