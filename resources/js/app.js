import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler'

import ProductListComponent from './Components/Product/ListComponent.vue'

const app = createApp({})

app.component('ProductListComponent', ProductListComponent)

app.mount('#app')