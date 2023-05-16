<template>
	<div>
		<div class="container pt-5">
			<div class="form-group d-inline-flex col-6">
				<div class="col-6">
					<label for="category_id">Producto</label>
					<select type="text" name="category_id" class="form-control" v-model="category_id">
						<option v-for="cat in root_categories" :value="cat.id">{{ cat.name }}</option>
					</select>
				</div>
				<div class="col-6" v-if="category_id">
					<label for="category_id">Categoría</label>
					<select type="text" name="category_id" class="form-control" v-model="subcategory_id">
						<option v-for="category in subcategories" :value="category.id">{{ category.name }}</option>
					</select>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Productos</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<div class="text-right">
							<router-link to="/create-product">
								<button>Añadir Producto</button>
							</router-link></div>
						<table class="table table-hover bg-light" v-if="products">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Artículo</th>
									<th scope="col">Precio</th>
									<th scope="col">Categoría</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<tr  v-for="product in products">
									<td>
										{{ product.id }}
									</td>
									<th scope="row">
										{{ product.title }}
									</th>
									<td>
										{{ product.price }}
									</td>
									<td>
										{{ product.category.name }}
									</td>
									<td class="text-right">
										<router-link :to="'/product/' + product.id">
											<i class="fas fa-edit"></i>
										</router-link>
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
		this.getProducts();
	},
	data: () => ({
		category_id: null,
		subcategory_id: null,
		products: null,
		root_categories: null,
		subcategories: null,
	}),
	methods:{
		getProducts(){
			let self = this
			if(this.subcategory_id){
				axios.get('/api/products/list/'+this.subcategory_id, {
				})
				.then(function (response) {
					self.products = response.data
					console.log(self.products)
				})
				.catch(function (error) {
					console.log(error);
				});
			}else{
				axios.get('/api/products', {
				})
				.then(function (response) {
					self.products = response.data
				})
				.catch(function (error) {
					console.log(error);
				});
			}
			
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
