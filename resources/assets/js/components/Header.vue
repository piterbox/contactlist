<template>
	<nav class="navbar navbar-expand-lg">
		<ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <router-link to="/" class="nav-link btn btn-outline-primary btn-lg" tag="a">Home</router-link>
	      </li>
	      <li class="nav-item">
	        <router-link to="/contacts" class="nav-link btn btn-outline-primary btn-lg" tag="a">Contact List</router-link>
	      </li>
	      <li class="nav-item">
	      	<router-link to="/contacts/add" class="nav-link btn btn-outline-success btn-lg" tag="a">Create new contact</router-link>
	      </li>
	    </ul>
	</nav>
</template>

<script>
	export default {

	}
</script>