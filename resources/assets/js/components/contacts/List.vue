<template>
    
        <div id="list">
            <div class="alert alert-primary mt-4" role="alert">
              <h4 class="alert-heading">Contact List</h4>
              <hr>
              <p class="mb-0">Here are all your contacts.</p>
            </div>
            
            <div class="row">
                <div class="list-group p-3 w-100" v-if="contacts.length > 0">
                    <transition-group name="list" tag="div">
                    <li class="list-group-item p-0 mb-2"
                        v-for="(contact, index) in contacts" :key="contact.id">
                        <div class="row align-items-center">
                            <div class="col">
                                <router-link :to="'/contacts/'+contact.id" 
                                            tag="a"
                                            class="list-group-item list-group-item-action m-0">
                                    {{contact.name}} {{contact.surname}}
                                </router-link>
                            </div>
                            <div class="col col-auto h-100">
                                <div class="text-right mr-4">
                                    <router-link :to="'/contacts/'+contact.id+'/edit'" 
                                                type="button"
                                                tag="button"
                                                class="btn btn-primary">
                                        Edit
                                    </router-link> 
                                    <button type="button" class="btn btn-danger" @click.prevent="deleteContact(contact.id, index)">Delete</button>
                                             
                                </div>
                            </div>
                        </div>
                    </li>
                    </transition-group>
                </div>
                <div class="p-3 w-100" v-else>
                    <div class="alert alert-warning">
                        You have no contacts yet!
                    </div>
                </div>

            </div> 
        </div>

</template>

<script>
import axios from 'axios';
    export default{
       data(){
            return {
                contacts: [
                
                ]
            }
       },
       methods:{
            getContacts(){
                //getting all contacts from server by ajax
                axios.get('http://contactlist/api/getcontacts')
                .then((response) => {
                    this.contacts = response.data;
                })
                .catch((error) => {console.log(error.response)});
            },
            deleteContact(id, index){
                if(confirm('Are you sure?')){
                    //deleting contact from contacts array
                    this.contacts.splice(index, 1);
                    //deleting contact from DB by ajax request
                    axios.delete('http://contactlist/api/contacts/'+id+'/delete')
                }
            }
       },
       mounted(){
            this.getContacts();
       },
    }
</script>

<style scoped>
    .list-enter-active, .list-leave-active {
        transition: all 1s ease; 
    }
    .list-enter, .list-leave-to{
        transform: translateX(30px);
        opacity: 0;
      
    }
   .list-move{
        transform: 1s;
    }
    
</style>
