<template>
	<div>
		<div class="container pt-5">
			<div class="panel panel-default">
				<div class="panel-heading">Gestionar Producto</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<div class="form-group">
							<label for="title">Producto</label>
							<input type="text" name="title" class="form-control" v-model="title">
						</div>

						<div class="form-group">
							<label for="description">Descripción</label><br>
							<textarea name="description" v-model="description">
								{{ description }}
							</textarea>
						</div>
						<div class="row">
							<div class="col">
								<label for="weight">Peso</label>
								<input type="number" step=".01" name="weight" class="form-control" v-model="weight">
							</div>
							<div class="col">
								<label for="max_size">Tamaño</label>
								<input type="number" step=".01" name="max_size" class="form-control" v-model="max_size">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="cost">Costo</label>
								<input type="number" step=".01" name="cost" class="form-control" v-model="cost">
							</div>
							<div class="col">
								<label for="mano">Mano de Obra</label>
								<input type="number" step=".01" name="mano" class="form-control" v-model="mano">
							</div>
							<div class="col">
								<label for="price">Precio</label>
								<input type="number" step=".01" name="price" class="form-control" v-model="price">
							</div>
						</div>
						<div class="form-group">
							<label for="parent_id">Producto</label>
							<select type="text" name="parent_id" class="form-control" v-model="parent_id">
								<option selected value=1>Pretensada</option>
								<option value=2>Armada</option>
								<option value=3>Pérgola</option>
								<option value=3>Hincos</option>
								<option value=3>Placas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="category_id">Categoría</label>
							<select type="text" name="category_id" class="form-control" v-model="category_id">
								<option v-for="category in subcategories" :value="category.id">{{ category.name }}</option>
							</select>
						</div>
						<div class="text-right">
							<button class="btn btn-primary" @click="storeProduct()">Guardar</button>
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
		this.parent_categories();
	},
	data: () => ({
		id: 0,
		title: '',
		description: '',
		parent_id: '',
		category_id: '',
		max_size: '',
		weight: '',
		price: '',
		cost: '',
		mano: '',

		root_categories: null,
		categories: null,
		subcategories: null,
		subcategory_id: null,
		products: null,
	}),
	methods:{
		storeProduct(){
			let self = this
			axios.post('/api/product/add', {		
				id: self.id,
				title: self.title,
				description: self.description,
				category_id: self.category_id,
				max_size: self.max_size,
				weight: self.weight,
				price: self.price,
				cost: self.cost,
				mano: self.mano,
			})
			.then(function (response) {
				self.id = response.data.id
				self.$toast.open({
                    message: 'Registor Agregado con éxito',
                    type: 'is-success'
                })
                self.$router.push({
    					name: 'product', 
    					params: { id: response.data.id }
					});
			})
			.catch(function (error) {
				self.$toast.open({
                    message: 'Complete los campos',
                    type: 'is-danger'
                })
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
			axios.get('/api/categories/list/'+self.parent_id, {
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
		'parent_id': function(){
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
