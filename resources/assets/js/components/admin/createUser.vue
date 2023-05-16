<template>
	<div>
		<div class="container pt-5">
			<div class="panel panel-default">
				<div class="panel-heading">Gestionar Usuario</div>
				<div class="panel-body">
					<div class="card-body bg-white">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" class="form-control" v-model="email">
						</div>

						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" name="password" class="form-control" v-model="password">
						</div>
						<div class="row">
							<div class="col">
								<label for="name">Nombre</label>
								<input type="text" name="name" class="form-control" v-model="name">
							</div>
							<div class="col">
								<label for="surname">Apellidos</label>
								<input type="text" name="surname" class="form-control" v-model="surname">
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="razon">Razón Social</label>
								<input type="text" name="razon" class="form-control" v-model="razon">
							</div>
							<div class="col">
								<label for="NIF">DNI ó CIF</label>
								<input type="text" name="NIF" class="form-control" v-model="NIF">
							</div>
							<div class="col">
								<label for="codigo">Código Cliente</label>
								<input type="text" name="codigo" class="form-control" v-model="codigo">
							</div>
						</div>
							
						<div class="form-group">
							<label for="address">Dirección</label>
							<input type="text" name="address" class="form-control" v-model="address">
						</div>
						<div class="row">
							<div class="col">
								<label for="city">Ciudad</label>
								<input type="text" name="city" class="form-control" v-model="city">
							</div>
							<div class="col" >
								<label for="pc">Código Postal</label>
								<input type="text" name="pc" class="form-control" v-model="pc">
							</div>
						</div>
						<div class="form-group">
							<label for="province">Provincia</label>
							<input type="text" name="province" class="form-control" v-model="province">
						</div>
						<div class="form-group">
							<label for="phone">Teléfono</label>
							<input type="text" name="phone" class="form-control" v-model="phone">
						</div>
						<div class="form-group">
							<label for="comercial_comission">Comisión Envío</label>
							<input type="number" name="delivery_comission" class="form-control" v-model="delivery_comission">
						</div>
						<div class="form-group">
							<label for="comercial">¿Es comercial?</label>
							<select type="text" name="comercial" class="form-control" v-model="comercial">
								<option selected value="0">No</option>
								<option value="1">Sí</option>
							</select>
						</div>
						<div class="form-group" v-if="comercials" v-show="!comercial">
							<label for="comercial_id">Comercial Asignado</label>
							<select type="text" name="comercial_id" class="form-control" v-model="comercial_id">
								<option v-for="comercial in comercials" :value="comercial.id">{{ comercial.name + comercial.surname}}</option>
							</select>
						</div>
						<div class="form-group" v-show="comercial">
							<label for="comercial_comission">Comisión Comercial</label>
							<input type="text" name="comercial_comission" class="form-control" v-model="comercial_comission">
						</div>
						<div class="text-right">
							<button class="btn btn-primary" @click="storeUser()">Guardar</button>
						</div>
						
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
		this.getComercials();
	},
	data: () => ({
		id: 0,
		email: '',
		password: '',
		name: '',
		surname: '',
		razon: '',
		NIF: '',
		codigo: '',
		address: '',
		city: '',
		pc: '',
		province: '',
		phone: '',
		comercial: 0,
		comercial_id: 0,
		comercial_comission: 0,

		comercials: null,
		categories: null,
		subcategories: null,
		products: null,
		provincias: ['Álava','Albacete','Alicante','Almería','Asturias','Ávila','Badajoz','Barcelona','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara','Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra','Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona','Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza'],
	}),
	methods:{
		storeUser(){
			if(!this.email || !this.password || !this.name || !this.surname){
				this.$toast.open({
                    message: 'Por favor complete el formulario',
                    type: 'is-danger'
                })
				return false
			}
			let self = this
			axios.post('/api/user/add', {		
				id: self.id,
				email: self.email,
				password: self.password,
				name: self.name,
				surname: self.surname,
				razon: self.razon,
				NIF: self.NIF,
				codigo: self.codigo,
				address: self.address,
				city: self.city,
				pc: self.pc,
				province: self.province,
				phone: self.phone,
				comercial_id: self.comercial_id,
				comercial: self.comercial,
				comercial: self.comercial,
				delivery_comission: self.delivery_comission,
			})
			.then(function (response) {
				self.$toast.open({
                    message: 'Agregado con éxito',
                    type: 'is-success'
                })
				if(response.data.id){
					self.$router.push({
    					name: 'user', 
    					params: { id: response.data.id }
					});
				}
				self.id = response.data.id
			})
			.catch(function (error) {
				console.log(error.response.data.message,"<------")
				swal(
					'Error!',
					error.response.data.message,
					'error'
					)
				console.log(error);
			});
		},
		getComercials(){
			let self = this
			axios.get('/api/user/comercials', {	
			})
			.then(function (response) {
				self.comercials = response.data
			})
			.catch(function (error) {
				console.log(error);
			});
		},
	}
};
</script>
<style scoped>
label{
	font-weight: bold;
}
</style>
