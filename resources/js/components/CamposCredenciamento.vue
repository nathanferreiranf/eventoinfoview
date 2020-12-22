<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Campos de credênciamento</h5>
            <button type="button" class="btn btn-secondary btn-sm d-flex align-items-center" @click="addCampo"><span class="material-icons mr-2">add</span> Novo campo</button>
        </div>
        <div class="form-group">
            <div class="input-group mb-2" v-for="(campo, $index) in campos" :key="$index">
                <div class="input-group-prepend">
                    <span class="input-group-text">Campo</span>
                </div>
                <input type="text" placeholder="Nome do campo" class="form-control" v-model="campo.text" />
                <input type="hidden" name="campos[]" :value="campo.text" />
                <input type="hidden" name="campos_obrigatorios[]" :value="campo.fl_obrigatorio" />
                <select class="custom-select" v-model="campo.fl_obrigatorio">
                    <option :value="0">Não obrigatório</option>
                    <option :value="1">Obrigatório</option>
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger d-flex" @click="delCampo($index)"><span class="material-icons">delete</span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        value: {
            type: Array,
            default: null
        }
    },
    data() {
        return {
            campos: [{
                text: '',
                fl_obrigatorio: 0
            }]
        };
    },
    methods: {
        addCampo(){
            this.campos.push({
                text: '',
                fl_obrigatorio: 0
            });
        },
        delCampo(index){
            this.campos.splice(index, 1);
        }
    },
    mounted(){
        if(this.value != null){
            this.campos = [];

            this.value.forEach(element => {
                this.campos.push({
                    text: element.nm_campo,
                    fl_obrigatorio: element.fl_obrigatorio
                });
            });
        }
    }
}
</script>

<style>

</style>