<template>
	<div>
		<nav class="navbar navbar-light navbar-expand-lg pt-0 pb-0" style="background-color: #3c4b64 !important;">
  			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<template v-for="category in root_categories">
					<li class="nav-item">
						<a href="#"class="nav-link font-weight-bold mr-5" 
						 :class="{ active : (category_id === category.id)}"
						@click="selectCategory(category.id)">{{ category.name }}
						</a>
						
					</li>
				</template>
			</ul>
		</nav>
		<div class="w-100 p-3" v-show="!category_id">
				<b-message title="Iniciar compra" type="is-warning" class="text-center" has-icon>
            		<h2>Seleccione alguna categoría de <strong>arriba</strong> para comprar</h2>
        		</b-message>
			
		</div>		

		<div class="container">
			
			<div class="w-100 p-3" v-if="user.root">
				<label for="cliente" >Cliente:  </label>
				<multiselect  v-model="cliente" :multiple="false" placeholder="Seleccione cliente" :options="clientes.map(cliente => cliente.id)" :custom-label="customLabel" label="razon" :option-height="20" v-if="clientes" ></multiselect>				
			</div>
			<div class="card bg-light mb-3 pt-3" v-if="category_id">
				<div class="row justify-content-md-center form-group form-inline mb-3" v-if="category_id">
						<label for="subcategory" v-if="categories != undefined && categories.length > 1">Tipo:  </label>
						<select name="subcategory" v-model="subcategory_id" class="form-control mr-3" v-if="categories != undefined &&categories.length > 1">
							<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
						</select>
						<div class="form-inline" v-show="selected_category.options">
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
						<h4><strong>Pedido</strong></h4>
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
							<th scope="col">Medida</th>
							<th scope="col">M/T</th>
							<th scope="col">Uds</th>
							<th scope="col">€/m</th>
							<th scope="col" class="text-right">Precio</th>
							<th scope="col" class="text-right">Opciones</th>
							<th scope="col"></th>
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
								{{ (item.size * item.qty).toFixed(2) }}
							</td>
							<td>
								<input type="number" name="qty" :value="item.qty" @input="updateQty(item.id,$event.target.value)" class="form-control col-md-3">
							</td>
							<td>
								<template v-if="!order">
									{{ (item.total / item.qty / item.size).toFixed(2)}} €
								</template>
								<template v-else>
									<template v-if="ship">
										<input type="number" step="0.01" name="PM" :value="(item.totalEnvio / item.qty / item.size).toFixed(2)" @input="updatePM(item.id,$event.target.value)" class="form-control col-md-4">
									</template>
									<template v-else>
										<input type="number" step="0.01" name="PM" :value="(item.total / item.qty / item.size).toFixed(2)" @input="updatePM(item.id,$event.target.value)" class="form-control col-md-4">
									</template>
								</template>
							</td>
							<td class="text-right">
								<template v-if="ship == 1">
									<strong>{{ item.totalEnvio }} €</strong>
								</template>
								<template v-if="ship == 0">
									<strong>{{ item.total }} €</strong>
								</template>
							</td>
							<td class="text-right">
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
					</tbody>
				</table>
			</div>
			<div class="card bg-light flex text-right p-3 mb-5">
				<div v-if="ship">
					<h1><strong>Total: {{ shipPrice }} €/IVA no incl.</strong></h1>
				</div>
				<div v-else="!ship">
					<h1><strong>Total: {{ totalPrice }} €/IVA no incl.</strong></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<b-upload v-model="dropFiles"
							 accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf,.dwg"
							multiple
							drag-drop>
							<section class="section">
								<div class="content has-text-centered">
									<p>
										<b-icon
										icon="upload"
										size="is-large">
									</b-icon>
								</p>
								<p>Arrastra y suelta tus archivos aquí</p>
							</div>
						</section>
					</b-upload>
				</div>

				<div class="col-8">
					<div class="form-group">
						
						<div class="row" style="margin-left: 0px;">
							<label for="comment" class="form-control col-md-4">Palos</label>
							<input style="margin-left: 18px;" type="number" step="0.01" v-model="palos" class="form-control col-md-4">
						</div>

						<label for="comment" class="form-control">Comentario</label>
						<textarea name="comment" v-model="comment" class="form-control"></textarea> 
						<div class="w-100 d-flex flex-row-reverse pt-4" v-if="items">
							<div>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#address-form">
		  							Opciones de Entrega
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<b-modal id="clientSelect" title="Seleccione Cliente" ok-title="Guardar" cancel-title="Cancelar" hide-footer :active.sync="showSelect" v-if="user.root">
			<div class="modal-header">
						<h5 class="modal-title">Iniciar pedido</h5>
			</div>
			<div class="modal-body">
				
	        	<label for="cliente">Seleccione cliente:  </label>
				<multiselect  v-model="cliente" placeholder="Seleccione cliente" track-by="id" :options="clientes.map(cliente => cliente.id)" :custom-label="customLabel" label="razon" :option-height="20" v-if="clientes" ></multiselect>
			</div>
			<div class="modal-footer">
						<button @click="showSelect=0" class="form-control btn-primary">Guardar</button>
			</div>
	    </b-modal>


		<div class="modal" tabindex="-1" id="address-form" role="dialog"  data-backdrop="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Opciones de entrega</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
					<div class="modal-body">
						<div class="form-inline w-100 justify-content-center">
							<label for="ship">Recogida en fábrica</label>
							<input type="radio" id="ship" value="0" v-model="ship" class="mr-5">
							<label for="ship">Envío a domicilio</label>
							<input type="radio" id="ship" value="1" v-model="ship">
						</div>
					
						<div v-show="ship == 1">
							<div class="panel panel-default">
								<div class="panel-body pt-3 pl-3 pr-3">
									<div class="form-group row">
										<label for="name" class="col-md-4">Nombre</label>
										<input type="text" name="name" v-model="name" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="surname" class="col-md-4">Apellidos</label>
										<input type="text" name="surname" v-model="surname" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="razon" class="col-md-4">Razón Social</label>
										<input type="text" name="razon" v-model="razon" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="address" class="col-md-4">Dirección</label>
										<input type="text" name="address" v-model="address" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="city" class="col-md-4">Ciudad</label>
										<input type="text" name="city" v-model="city" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="pc" class="col-md-4">Código Postal</label>
										<input type="text" name="pc" v-model="pc" class="form-control col-md-8">
									</div>
									<div class="form-group row">
										<label for="province" class="col-md-4">Provincia</label>
										<input type="text" name="province" v-model="province" class="form-control col-md-8">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="text-right">
							<h1><strong>Total: {{ shipPrice }} €/IVA no incl.</strong></h1>
						</div>
					</div>
					<div class="modal-footer" v-if="!order">
						<button @click="store()" class="form-control btn-primary" :disabled="!items.length"> Tramitar pedido</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'
import {mapGetters,mapState} from 'vuex';

export default {
	props:['category'],

	computed: {
		...mapGetters([
		'isLoggedIn'
		]),
	
		...mapState({
			user: state => state.auth
		})
	},
	mounted (){
		if(this.$route.params.id){
			this.order = parseInt(this.$route.params.id)
		}
		this.parent_categories()
		if(this.order){
			this.get_orderCart()
		}else{
			this.get_cart()
		}
		if(this.user.root || this.user.admin || this.user.comercial || this.tecnico){
			this.getClientes()
		}
		this.getMe()
		this.qty = 10
	},
	data: () => ({
		cliente: null,
		clientes: null,
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
		dropFiles: null,
		items: 0,
		max_size: null,
		qty: 0,
		cart: null,
		size: null,
		weight: 0,
		totalPrice: 0,
		shipPrice: 0,
		tmpQty: 0,
		imageSelected: null,
		//form
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
		delivery_comission: 0,
		showSelect: true,

		
	}),
	methods:{
		customLabel(opt){
			var linea = this.clientes.find(x => x.id == opt)
			return linea.NIF + " - " + linea.razon
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
		getMe(){
			let self = this
			axios.get('/api/user/me', {
			})
			.then(function (response) {
				self.name = response.data.name
				self.surname = response.data.surname
				self.razon = response.data.razon
				self.address = response.data.address
				self.city = response.data.city
				self.pc = response.data.pc
				self.province = response.data.province
				self.delivery_comission = response.data.delivery_comission
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		getClientes(){
			let self = this
			axios.get('/api/users', {
			})
			.then(function (response) {
				self.clientes = response.data
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
		get_products_by_size(){
			let self = this
			console.log(this.cliente,"<------")
			if(!this.cliente){
				self.$toast.open({
                    message: 'Seleccione cliente por favor!',
                    type: 'is-danger'
                })
                return
			}
			axios.post('/api/products/size/'+self.subcategory_id+'/'+self.size+'/'+self.qty + '/' + self.order + '/' + self.cliente , {
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
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		store(){
			let self = this

			axios.post('/api/order/store',{
				name: this.name,
				surname: this.surname,
				address: this.address,
				razon: this.razon,
				NIF: this.NIF,
				city: this.city,
				pc: this.pc,
				province: this.province,
				comment: this.comment,
				palos: this.palos,
				total: this.totalPrice,
				delivery_comission: this.delivery_comission,
				cliente: this.cliente,
				ship: this.ship,
			})
			.then(function (response) {
				self.$toast.open({
                    message: 'Pedido realizado con éxito',
                    type: 'is-success'
                })
                $('#address-form').modal('hide')
				self.shipPrice = 0
                self.get_cart()
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
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		removeItem(id){
			let self = this
			axios.post('/api/items/delete/'+id, {
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
			console.log("va")
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
		updatePM(id,PM){
			let self = this
			axios.post('/api/items/edit/'+id, {
				PM: PM,
				qty: 0,
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
		cliente: function(){
			if(!this.cliente){
				return
			}
			let self = this
			axios.get('/api/items/user/'+this.cliente, {
			})
			.then(function (response) {
				self.items = response.data.data
				self.weight = response.data.weight.toFixed(2)
				self.totalPrice = response.data.total.toFixed(2)
			})
			.catch(function (error) {
				console.log(error);
			});
			axios.get('/api/user/read/'+this.cliente, {
			})
			.then(function (response) {
				self.name = response.data.user.name
				self.surname = response.data.user.surname
				self.razon = response.data.user.razon
				self.city = response.data.user.city
				self.pc = response.data.user.pc
				self.delivery_comission = response.data.user.delivery_comission
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		ship: function(){
			if(this.ship == 1){
				this.shipPrice = (this.totalPrice * (this.delivery_comission/100 + 1)).toFixed(2)
			}else{
				this.shipPrice = this.totalPrice
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
.animation-content,.modal-content{ 
    height: 65%;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
