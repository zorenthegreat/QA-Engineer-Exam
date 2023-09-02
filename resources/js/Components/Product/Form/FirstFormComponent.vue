<template>
    <div>
        <div class="row">
            <div class="col-6">Name</div>
            <div class="col-6"><input v-model="form.name" class="form-control" type="text" /></div>
        </div>
        <div class="row">
            <div class="col-6">Category</div>
            <div class="col-6">
                <select class="form-control" name="category">
                    <option v-for="(category, key) in categoryEnum" :key="key">
                        {{ category }}
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-6">Description</div>
            <div class="col-6">
                <ckeditor :editor="editor" v-model="form.description"></ckeditor>
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: ['form', 'categoryEnum'],
        data () {
            return {
                editor: ClassicEditor,
                description: '<h1>Test</h1>',
                editorConfig: {
                    // The configuration of the editor.
                }
            }
        },
        created () {
            console.log('First Form Created')
        },
        methods: {
        }
    }
</script>