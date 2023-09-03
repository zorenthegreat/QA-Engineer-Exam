<template>
    <div class="row">
        <div class="col col-md-11 mx-auto">
            <div class="card p-2">
                <div class="card-header">
                    Product Create
                </div>
                <div class="card-body">
                    <first-component :form="form" v-if="step == 1" :category-enum="categoryEnum" />
                    <second-component :form="form" v-if="step == 2" />
                    <third-component :form="form" v-if="step == 3" />
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
    import ThirdComponent from './Form/ThirdFormComponent.vue'

    export default {
        components: { FirstComponent, SecondComponent, ThirdComponent },
        props: ['product', 'categoryEnum'],
        data () {
            return {
                step: 1,
                form: {
                    name: '',
                    description: '',
                    category: 0,
                    date_time: '',
                    images: []
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
                this.form.date_time = this.form.date_time ? new Date(this.form.date_time).toISOString() : ''

                const message = this.product ? 'Updated' : 'Saved'
                const apiRoute = this.product ? route('api.products.update', this.product) : route('api.products.store')
                const data = new FormData()

                for (const key in this.form) {
                    if (key == 'images') {
                        this.form[key].forEach(image => {
                            console.log(image)
                            data.append('images[]', image.file, image.name)
                        })
                    } else {
                        data.append(key, this.form[key])
                    }
                }

                if (this.product) {
                    data.append('_method', 'PUT')
                }

                axios({
                    method: 'POST',
                    url: apiRoute,
                    data: data,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(async response => {
                    if (response.status == 200) {
                        await this.$swal(
                            `Successfully ${message}!`,
                            'Press OK to redirect to products list',
                            'success'
                        ).then(result => {
                            if (result.isConfirmed) {
                                window.location.href = route('product.index')
                            }
                        })
                    }
                }).catch(error => {
                    console.error('Error fetching data:', error);
                })
            }
        }
    }
</script>