<template>
	<div>
		<div class="container pt-5">
			<div class="panel panel-default">
				<div class="panel-heading">Gestionar Usuario.</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" class="form-control" v-model="user.email">
						</div>

						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" name="password" class="form-control" v-model="user.password">
						</div>
						<div class="row">
							<div class="col">
								<label for="name">Nombre</label>
								<input type="text" name="name" class="form-control" v-model="user.name">
							</div>
							<div class="col">
								<label for="surname">Apellidos</label>
								<input type="text" name="surname" class="form-control" v-model="user.surname">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="razon">Razón Social</label>
								<input type="text" name="razon" class="form-control" v-model="user.razon">
							</div>
							<div class="col">
								<label for="NIF">DNI ó CIF</label>
								<input type="text" name="NIF" class="form-control" v-model="user.NIF">
							</div>
							<div class="col">
								<label for="codigo">Código Cliente</label>
								<input type="text" name="NIF" class="form-control" v-model="user.codigo">
							</div>
						</div>
							
						<div class="form-group">
							<label for="address">Dirección</label>
							<input type="text" name="address" class="form-control" v-model="user.address">
						</div>
						<div class="row">
							<div class="col">
								<label for="city">Ciudad</label>
								<input type="text" name="city" class="form-control" v-model="user.city">
							</div>
							<div class="col" >
								<label for="pc">Código Postal</label>
								<input type="text" name="pc" class="form-control" v-model="user.pc">
							</div>
						</div>
						<div class="form-group">
							<label for="province">Provincia</label>
							<input type="text" name="province" class="form-control" v-model="user.province">
						</div>
						<div class="form-group">
							<label for="phone">Teléfono</label>
							<input type="text" name="phone" class="form-control" v-model="user.phone">
						</div>
						<div class="form-group">
							<label for="phone">Comisión Envío</label>
							<input type="number" name="delivery_comission" class="form-control" v-model="user.delivery_comission">
						</div>
						<div class="text-right">
							<button class="btn btn-primary" @click="storeUser()">Guardar</button>
						</div>
						
					</div>
				</div>
			</div>
			<div class="container pt-5">
				<div class="panel panel-default">

					<div class="panel-heading">Descuentos</div>
					<div class="panel-body">
						<div class="card-body bg-white">

							<select name="categories" v-model="category_id" class=" mr-3">
								<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
							</select>

							<select name="subcategories" v-model="subcategory_id" class=" mr-3">
								<option v-for="subcategory in subcategories" :value="subcategory.id">{{ subcategory.name }}</option>
							</select>

							<select name="products" v-model="product_id" class=" mr-3">
								<option v-for="product in products" :value="product.id">{{ product.title }}</option>
							</select>

							<input type="number" name="discount" v-model="discount">

							<button class="btn btn-primary" :disabled="!category_id || !subcategory_id || !product_id" @click="storeDiscount">Añadir</button>

							<table class="table table-hover bg-light" v-if="discounts">
								<thead>
									<tr>
										<th scope="col">Producto</th>
										<th scope="col">Descuento</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<tr  v-for="discount in discounts">
										<td>
											{{ discount.product_id }}
										</td>
										<th scope="row">
											{{ discount.discount }}
										</th>
										<td class="text-right">
											<div @click="delDiscount(discount.id)">
												<i class="fas fa-trash"></i>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
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
		this.id = parseInt(this.$route.params.id)
		this.parent_categories()
		this.getUser();
	},
	data: () => ({
		user:{
			id: 0,
			email: '',
			password: '',
			name: '',
			surname: '',
			razon: '',
			NIF: '',
			address: '',
			city: '',
			pc: '',
			province: '',
			phone: '',
		},

		discounts: [],
		discount: 0,
		categories: {},
		category_id: 0,
		subcategories: null,
		subcategory_id: 0,
		products: null,
		product_id: 0,
		provincias: ['Álava','Albacete','Alicante','Almería','Asturias','Ávila','Badajoz','Barcelona','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara','Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra','Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona','Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza'],
	}),
	methods:{
		storeUser(){
			let self = this
			axios.post('/api/user/profile/update', {		
				id: self.user.id,
				email: self.user.email,
				password: self.user.password,
				name: self.user.name,
				surname: self.user.surname,
				razon: self.user.razon,
				NIF: self.user.NIF,
				address: self.user.address,
				city: self.user.city,
				pc: self.user.pc,
				province: self.user.province,
				phone: self.user.phone,
				delivery_comission: self.user.delivery_comission,
			})
			.then(function (response) {
				self.id = response.data.id
				self.$toast.open({
                    message: 'Editado con éxito',
                    type: 'is-success'
                })
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		storeDiscount(){
			let self = this
			axios.post('/api/user/discount/store', {		
				user_id: self.id,
				product_id: self.product_id,
				discount: self.discount,
			})
			.then(function (response) {
				self.discounts = response.data.discounts
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		delDiscount(id){
			let self = this
			axios.post('/api/user/discount/remove/'+id, {
				user_id: self.id,
			})
			.then(function (response) {
				self.discounts = response.data.discounts
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		getUser(){
			let self = this
			axios.get('/api/user/read/'+this.id, {
			})
			.then(function (response) {
				self.user = response.data.user
				self.discounts = response.data.discounts
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
				self.categories = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		getProducts(){
			let self = this
			axios.get('/api/products/list/'+this.subcategory_id, {
			})
			.then(function (response) {
				self.products = response.data
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
		subcategory_id: function(){
			this.getProducts();
		},
	},
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
