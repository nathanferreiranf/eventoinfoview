<template>
    <div>
        <div ref="editor"></div>
        <textarea ref="editorText" name="descricao" class="d-none"></textarea>
    </div>
</template>

<script>
import 'quill/dist/quill.snow.css'
import Quill from 'quill';

export default {
    props: {
        value: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        loading: false,
        editor: null
    }),
    methods: {
        onEditorChange(event) {
            console.log('onEditorChange')
        }
    },
    mounted() {
        this.editor = new Quill(this.$refs.editor, {
            placeholder: 'Descrição do evento...',
            theme: 'snow'
        });

        this.editor.root.innerHTML = this.value;

        this.editor.on('text-change', (delta, oldDelta, source) => {
            this.$refs.editorText.textContent = this.editor.root.innerHTML;
        });
    }
}
</script>

<style>

</style>