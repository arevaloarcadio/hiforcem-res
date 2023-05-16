<template>
	<div>
		<div class="container pt-5">
			<div>
				
				<label for="category_id">Buscar</label>
				<input type="text" name="search" id="search" v-model="keyword" class="form-control" @keydown.enter="search">
				
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<div class="text-right">
							<router-link to="create-user">
								<button>Añadir Usuario</button>
							</router-link></div>
						<table class="table table-hover bg-light" v-if="users">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Nombre</th>
									<th scope="col">Apellidos</th>
									<th scope="col">Razón</th>
									<th scope="col"></th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<tr  v-for="user in users">
									<td>
										{{ user.id }}
									</td>
									<th scope="row">
										{{ user.name }}
									</th>
									<td>
										{{ user.surname }}
									</td>
									<td>
										{{ user.razon }}
									</td>
									<td class="text-right">
										<router-link :to="'/user/' + user.id">
											<i class="fas fa-edit"></i>
										</router-link>
									</td>
									<td class="text-right">
										<a  @click="remove(user.id)" >Borrar</a>
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
import swal from 'sweetalert2'

export default {
	props:['section'],
	mounted (){
		this.getUsers();
	},
	data: () => ({
		users: null,
		keyword: '',
	}),
	methods:{
		getUsers(){
			let self = this
			axios.get('/api/users', {
			})
			.then(function (response) {
				self.users = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		search(){
			let self = this
			axios.post('/api/users/search', {
				search: self.keyword,
			})
			.then(function (response) {
				self.users = response.data
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
    				axios.post('/api/user/remove/' + id, {
				})
				.then(function (response) {
					self.getUsers();
					swal(
	      					'¡Borrado!',
	    					'Usuario eliminado.',
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
