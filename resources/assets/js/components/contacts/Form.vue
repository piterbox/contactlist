<template>
    <div class="card">
        <transition name="fade" mode="out-in" appear>
        <div class="alert alert-danger mt-4" role="alert" v-if="error">
            <p class="mb-0">Something of given data is empty or wrong.</p>
        </div>
        </transition>
        <transition name="fade" mode="out-in" appear>
        <div class="alert alert-danger mt-4" role="alert" v-if="error404">
            <p class="mb-0">Oops! Error 404!</p>
        </div>
        </transition>
        <transition name="fade" mode="out-in" appear>
        <div class="alert alert-success mt-4" role="alert" v-if="success">
            <p class="mb-0">The contact was saved!.</p>
        </div>
        </transition>
      
    </transition>
    <div class="row justify-content-center card-body">
    <form class="col col-md-8" @submit.prevent ="sendData">
        <div class="form-group row">
            <label for="name" class="col-sm-4">Name</label>
            <input type="text"
                    class="form-control col-sm-8" 
                    id="name" 
                    placeholder="Enter name"
                    aria-describedby="nameHelp"
                    v-model="contact.name">
            <small id="nameHelp" class="form-text text-muted offset-md-4">Name should have more then 3 symbols.</small>
        </div>
        <div class="form-group row">
            <label for="surname" class="col-sm-4">Surname</label>
            <input type="text" 
                    class="form-control col-sm-8" 
                    id="surname" 
                    placeholder="Enter surname"
                    aria-describedby="surnameHelp"
                    v-model="contact.surname">
            <small id="surnameHelp" class="form-text text-muted offset-md-4">Surname should have more then 3 symbols.</small>
        </div>
        <div class="form-group row" >
            <label for="email" class="col-sm-4">Email address</label>
            <input type="email" 
                    name="email" 
                    class="form-control col-sm-8" 
                    id="email" 
                    placeholder="Enter email"
                    aria-describedby="emailHelp"
                    v-model="contact.email">
            <small id="emailHelp" class="form-text text-muted offset-md-4">Email should be correctly.</small>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-4">Phone</label>
            <input type="text" 
                    class="form-control col-sm-8" 
                    id="phone" 
                    placeholder="Enter phone number"
                    aria-describedby="phoneHelp"
                    v-model="contact.phone">
            <small id="phoneHelp" class="form-text text-muted offset-md-4">Phone should have only numbers.</small>
        </div>
        <div class="form-group row" >
            <label for="date_birth" class="col-sm-4">Date of birthday</label>
            <input type="date" 
                    class="form-control col-sm-8" 
                    id="date_birth" 
                    name="date_birth" 
                    placeholder="Enter date of birthday"
                    aria-describedby="dateHelp"
                    v-model="contact.date_birth">
            <small id="dateHelp" class="form-text text-muted offset-md-4">Date should be less then a current date.</small>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary offset-sm-4">Save</button>
        </div>
    </form>
</div>
</div>
</template>

<script>
import axios from 'axios';
    export default {
       data(){
            return {
                contact:{
                    name: '',
                    surname: '',
                    email: '',
                    phone: '',
                    date_birth: '', 
                },
                error: false,
                error404: false, 
                success: false,
            }
       },
       beforeMount(){
            this.getContact();
       },
       methods:{
            sendData(){
                if(this.contact.name != '' || this.contact.surname != '' || this.contact.email != '' || this.contact.phone != '' || this.contact.date_birth != '')
                {
                    if(this.$route.params.id == '' || this.$route.params.id == undefined)
                    {
                    //sending data to server by ajax to create new contact and save data in DB
                        axios.post(this.$route.base+'api/contacts', this.contact)
                            .then((response) => {
                                if(response.data.success){
                                    this.contact.name = '';
                                    this.contact.surname = '';
                                    this.contact.email = '';
                                    this.contact.phone = '';
                                    this.contact.date_birth = '';
                                    this.error = false;
                                    this.success = true;
                                }
                                else{
                                    this.error = true;
                                }
                            })
                            .catch((error) => {console.log(error.response);
                                this.error404 = true});

                            setTimeout(()=>{
                                this.success = false;
                                this.error404 = false;
                                this.error = false;
                            }, 3000);
                    }
                    else
                    {
                        axios.put(this.$route.base+'api/contacts/'+this.$route.params.id+'/edit', this.contact)
                            .then((response) => {
                                if(response.data.success){
                                    this.error = false;
                                    this.success = true;
                                }
                                else{
                                    this.error = true;
                                }
                            })
                            .catch(() => {this.error404 = true});

                            setTimeout(()=>{
                                this.success = false;
                                this.error404 = false;
                                this.error = false;
                            }, 3000);

                    }
                
                }
                else{
                   this.error = true; 
                   setTimeout(()=>{
                        this.error = false;
                    }, 3000); 
                }   
            },
            getContact(){
                if(this.$route.params.id != '' || this.$route.params.id != undefined){
                    axios.get(this.$route.base+'api/contacts/'+this.$route.params.id)
                    .then((response) => {
                        this.contact = response.data;
                    })
                    .catch((error) => {});
                }
            }
       }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1s;
    }
    .fade-enter, .fade-leave{
        opacity: 0;
        transition: opacity 1.5s;
    }
</style>