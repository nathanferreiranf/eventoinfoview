<template>
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="arquivo in files" :key="arquivo.id">
                    <td style="vertical-align: middle" nowrap>{{ arquivo.lk_arquivo.split('/')[1] }}</td>
                    <td style="vertical-align: middle" nowrap>
                        <button type="button" class="btn btn-sm btn-danger" @click="deletar(arquivo)">Deletar</button>
                    </td>
                </tr>
                <tr v-if="arquivos.length == 0">
                    <td class="text-center" colspan="2">Nenhum arquivo no momento.</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        sala: {
            type: Object,
            default: null
        },
        arquivos: {
            type: Array,
            default: []
        },
        token: {
            type: String,
            default: null
        }
    },
    data: () => ({
        files: [],
    }),
    methods: {
        deletar(arquivo){
            axios.delete('/admin/arquivos/'+arquivo.id, {
                _token: this.token
            }).then(({data}) => {
                this.files = data;
            }).catch(error => {
                console.log(error);
            }).finally();
        }
    },
    mounted(){
        this.files = this.arquivos;
    }
}
</script>