<template>
	<div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0" style="background-color:rgb(48 60 80)!important;color: #fff">
			<div class="container pt-0">
				<router-link class="navbar-brand" :to="{name: 'index'}" v-once>{{ siteName }}</router-link>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">

						<router-link :to="{name: 'ships'}" tag="li" class="nav-item" activeClass="active">
							<a class="nav-link">Envíos</a>
						</router-link>
						<router-link :to="{name: 'orders'}" tag="li" class="nav-item" activeClass="active">
							<a class="nav-link">Pedidos</a>
						</router-link>
						<router-link :to="{name: 'stats'}" tag="li" class="nav-item" activeClass="active" v-if="user.root">
							<a class="nav-link">Estadísticas</a>
						</router-link>
						<router-link :to="{name: 'products'}" tag="li" class="nav-item" activeClass="active">
							<a class="nav-link">Productos</a>
						</router-link>
						<router-link :to="{name: 'users'}" tag="li" class="nav-item" activeClass="active" >
							<a class="nav-link">Usuarios</a>
						</router-link>
						<li class="nav-item" v-show="isLoggedIn">
							<a class="nav-link" href="#" @click.prevent="logout">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
	</div>
</template>

<script>
import {siteName} from './../../config';
import {mapGetters,mapState} from 'vuex';
import jwtToken from '../../helpers/jwt-token';
import axios from 'axios'


export default {
	data() {
		return {
			siteName: siteName,
		}
	},
	computed: {
		...mapGetters([
		'isLoggedIn'
		]),
	
		...mapState({
			user: state => state.auth
		})
	},
	methods: {
		logout() {
			jwtToken.removeToken();
			this.$store.dispatch('unsetAuthUser')
			.then(() => {
				this.$noty.success('You are logged out');
				this.$router.push({name: 'login'});
			});
		},
		
	}
}
</script>
