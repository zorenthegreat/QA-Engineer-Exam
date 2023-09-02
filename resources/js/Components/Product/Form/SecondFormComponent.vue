<template>
    <div>
        <input v-model="form.images" />
    </div>
</template>

<script>
    export default {
        props: ['form'],
        data () {
            return {
            }
        },
        created () {
            console.log('Second Form Created')
        },
        methods: {
        }
    }
</script>