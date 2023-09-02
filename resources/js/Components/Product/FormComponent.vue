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
                    <a v-if="step != 1" class="btn btn-light" @click="back">Back</a>
                    <a v-if="step != 3" class="btn btn-dark" @click="next">Next</a>
                    <a v-if="step == 3" class="btn btn-dark" @click="submit">Submit</a>
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
        props: ['categoryEnum'],
        data () {
            return {
                step: 1,
                form: {
                    name: '',
                    description: '',
                    images: ''
                }
            }
        },
        created () {
            console.log('Parent Form Created')
        },
        methods: {
            next () {
                this.step++
            },
            back () {
                this.step--
            },
            submit () {
                console.log(this.form)
            },
        }
    }
</script>