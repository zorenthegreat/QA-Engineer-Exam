<template>
    <div class="row">
        <div class="col-11 mx-auto">
            <div class="card p-2">
                <div class="card-header">
                    Product Create
                </div>
                <div class="card-body">
                    <first-component :form="form" v-if="step == 1" :category-enum="categoryEnum" />
                    <second-component :form="form" v-if="step == 2" />
                </div>
                <div class="card-footer">
                    <div class="row" :class="{ 'justify-content-end': isPageOne, 'justify-content-between': !isPageOne }">
                        <a v-if="step != 1" class="btn btn-light" @click="back">Back</a>
                        <a v-if="step != 3" class="btn btn-dark" @click="next">Next</a>
                        <a v-if="step == 3" class="btn btn-dark" @click="submit">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FirstComponent from './Form/FirstFormComponent.vue'
    import SecondComponent from './Form/SecondFormComponent.vue'

    export default {
        components: { FirstComponent, SecondComponent },
        props: ['product', 'categoryEnum'],
        data () {
            return {
                step: 1,
                form: {
                    name: '',
                    description: '',
                    category: 0,
                    images: ''
                }
            }
        },
        computed: {
            isPageOne () {
                return this.step == 1
            }
        },
        created () {
            console.log('Parent Form Created')

            if (this.product) {
                this.form = this.product
            }
        },
        methods: {
            next () {
                this.step++
            },
            back () {
                this.step--
            },
            submit () {
                axios.post(route('api.products.store')).then(response => {
                    this.fetchProducts(this.page.current)
                }).catch(error => {
                    console.error('Error fetching data:', error);
                })
            }
        }
    }
</script>