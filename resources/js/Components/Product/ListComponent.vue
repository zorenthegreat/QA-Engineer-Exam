<template>
    <div class="row">
        <div class="col">
            <div class="card p-2">
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(product, key) in products" :key="key">
                            <td>{{ product.name }}</td>
                            <td>{{ product.category }}</td>
                            <td>{{ product.description }}</td>
                            <td><a href="" class="btn btn-secondary">Edit</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['token'],
        data() {
            return {
                products: []
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.fetchProducts()
        },
        methods: {
            fetchProducts () {
                axios.get('/api/products', {
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                }).then(response => {
                    this.products = response.data.data
                })
            },
        }
    }
</script>
