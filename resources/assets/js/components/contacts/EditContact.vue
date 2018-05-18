<template>
  
    <div>
      <div class="alert alert-primary mt-4" role="alert">
        <h4 class="alert-heading">Data of contact</h4>
        <hr>
        <p class="mb-0">Please fell out or change all fields to edit contact.</p>
      </div>
	    <app-form></app-form>
	  </div>

</template>

<script>
	import Form from './Form'
    export default {
       components:{
       	appForm: Form
       }
    }
</script>

