import './bootstrap';
import './ziggy';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { createApp } from 'vue/dist/vue.esm-bundler'

import ProductListComponent from './Components/Product/ListComponent.vue'

const app = createApp({})

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#6c757d',
};

app.component('ProductListComponent', ProductListComponent)
app.use(VueSweetalert2, options)
app.mount('#app')