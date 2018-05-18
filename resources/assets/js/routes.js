import List from './components/contacts/List.vue';
import EditContact from './components/contacts/EditContact.vue';
import ContactDetails from './components/contacts/ContactDetails.vue';
import CreateContact from './components/contacts/CreateContact.vue';

export default 
{
  mode: 'history',
  base: 'http://contactlist/',
  routes: [
    {path: '/contacts', component: List},
    {path: '/contacts/add', component: CreateContact},
    {path: '/contacts/:id', component: ContactDetails, name: 'contactdetails'},
    {path: '/contacts/:id/edit', component: EditContact, name: 'contactedit'} ,
    {path: '/contacts/*', redirect: '/'} 
   ]
};