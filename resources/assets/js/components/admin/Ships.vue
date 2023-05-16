<template>
	<div>
		<div class="container pt-5">
			<div class="panel panel-default">
				<div class="panel-heading">Envíos</div>
				<div class="panel-body">
					<button @click="createShip()">Añadir Envío</button>

					<div class="card-body bg-white">
						<table class="table table-hover bg-light" v-if="ships">
							<thead>
								<tr>
									<th scope="col">N</th>
									<th scope="col">Estado</th>
									<th scope="col">Peso</th>
									<th scope="col">Carga</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr  v-for="ship in ships">
									<td>
										{{ ship.id }}
									</td>
									<th scope="row">
										{{ ship.status }}
									</th>
									<td>
										{{ ship.weights }}
									</td>
									<td>
										{{ ship.weight }}
									</td>
									<td class="text-right">
										<router-link :to="'/ship/' + ship.id">
											<i class="fas fa-edit"></i>
										</router-link>
									</td>
									<td class="text-right">
										<a  @click="remove(ship.id)" >Borrar</a>
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
import swal from 'sweetalert2'
import axios from 'axios'

export default {
	props:['section'],
	mounted (){
		this.getShips();
	},
	data: () => ({
		ships: null,
	}),
	methods:{
		getShips(){
			let self = this
			axios.get('/api/ships', {
			})
			.then(function (response) {
				self.ships = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
		createShip(){
			let self = this
			axios.post('/api/ship/store', {
				weights: '15000',
				weight: '0',
				status: 'Vacio',
			})
			.then(function (response) {
				self.$router.push('/ship/'+response.data.id);
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
    				axios.post('/api/ship/remove/' + id, {
				})
				.then(function (response) {
					self.getShips();
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
