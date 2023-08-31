<template>
    <div class="row">
        <div class="col-11 mx-auto">
            <div class="card p-2">
                <div class="card-header">
                    <div class="row flex-column flex-md-row">
                        <input v-model="keyword" @keypress.enter="search" class="form-control col-12 col-md-6" type="text" placeholder="Search Product..." />
                        <select v-model="category" class="form-control col-12 col-md-3 mx-md-1 my-1 my-md-0">
                            <option value>&mdash;</option>
                            <option v-for="(category, key) in categories" :key="key" :value="key">{{ category }}</option>
                        </select>
                        <div class="text-right text-md-left">
                            <a class="btn btn-secondary btn-circle" @click="search">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table v-if="products.length > 0">
                        <thead class="text-center">
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(product, key) in products" :key="key">
                                <td>{{ product.name }}</td>
                                <td>{{ product.category }}</td>
                                <td>{{ product.description }}</td>
                                <td>
                                    <a href="" class="btn btn-dark">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center">
                        No Results
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['token', 'categoryEnum'],
        data() {
            return {
                keyword: '',
                category: '',
                categories: [],
                products: [],
                page: {
                    previous: 1,
                    current: 1,
                    last: 1
                },
            }
        },
        created() {
            this.fetchProducts()
            this.processCategories()
        },
        mounted () {
            console.log('Component mounted.')
        },
        methods: {
            fetchProducts () {
                axios.get('/api/products', {
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    },
                    params: {
                        keyword: this.keyword,
                        category: this.category
                    }
                }).then(response => {
                    this.products = response.data.data
                })
            },
            processCategories () {
                let items = {}

                Object.entries(this.categoryEnum).forEach(([key, category]) => {

                    items[key] = category
                })

                this.categories = items
            },
            search () {
                this.products = []
                this.fetchProducts()
            }
        }
    }
</script>

<style scoped>
td {
    padding: 5px 25px;
}
</style>