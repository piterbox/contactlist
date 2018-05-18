<template>
	<transition name="slide" mode="out-in" appear>
	<div>
      <div class="alert alert-primary mt-4" role="alert">
        <h4 class="alert-heading">Contact details</h4>
        <hr>
        <p class="mb-0">This is detail information about contact.</p>
      </div>
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="card text-center">
			    	<h5 class="card-header">
				    	{{contact.name}} {{contact.surname}}
				  	</h5>
					 <ul class="list-group list-group-flush ">
					    <li class="list-group-item">Name: <strong class="text-center">{{contact.name}}</strong></li>
					    <li class="list-group-item">Surname: <strong>{{contact.surname}}</strong></li>
					    <li class="list-group-item">Email: <strong>{{contact.email}}</strong></li>
					    <li class="list-group-item">Phone: <strong>{{contact.phone}}</strong></li>
					    <li class="list-group-item">Date of birthday: <strong>{{contact.date_birth}}</strong></li>
					    <li class="list-group-item">
					    	<router-link :to="'/contacts/'+contact.id+'/edit'" 
		                                type="button"
		                                tag="button"
		                                class="btn btn-primary">
		                        Edit
		                    </router-link> 
		                    <button type="button"
		                        class="btn btn-danger"
		                        @click.prevent="deleteContact">
		                        Delete
		                    </button>
		                </li>
					</ul>
			    </div>
			</div>
		</div>
	  </div>
	  </transition>
</template>
<script>
	import axios from 'axios';
	export default{
		data(){
			return {
				contact: {},
				confirmed: false
			}
		},
		beforeMount(){
			this.getContact();
		},
		methods:{
			getContact(){
				if(this.$route.params.id != ''){
                    axios.get('http://contactlist/api/contacts/'+this.$route.params.id)
                    .then((response) => {
                        this.contact = response.data;
                    })
                    .catch((error) => {});
                }
            },
            deleteContact(){
            	if(confirm('Are you sure?')){
            		//sending request to delete this contact from DB
            		axios.delete('http://contactlist/api/contacts/'+this.$route.params.id+'/delete')
            		//if contact will have deleted redirecting to contact list
                	.then((response) => {this.$router.push('/contacts');})
            		
            	}
            },
        }
	}
</script>

<style scoped>
	.slide-enter-active{
    	animation: slide-in 300ms ease-out;
	}
	.slide-leave-active{
	    animation: slide-out 1ms;
	}

  @keyframes slide-in{
    from{
      transform: translateY(-30px);
      opacity: 0;
    }
    to{
      transform: translateY(0px);
      opacity: 1;
    }
  }

  @keyframes slide-out{
    from{
      opacity: 1;
    }
    to{
      opacity: 0;
    }
 }
</style>