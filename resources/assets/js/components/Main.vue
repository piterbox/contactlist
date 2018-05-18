<template>
	<div>
		<app-header></app-header>
		<transition name="slide" mode="out-in" appear>	
			<div class="alert alert-success mt-5" v-if="$route.path == '/'">
				<h2 class="text-center">Wellcome!</h2>
				<hr>
				<h3 class="text-center">This is application "Contact List".</h3>
			</div>
		</transition>
		<transition name="slide" mode="out-in" appear>	
		<router-view></router-view>
		</transition>
	</div>
</template>

<script>
	import Header from './Header';
	export default{
		components:{
			appHeader: Header
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