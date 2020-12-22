<template>
    <div>
        <span class="text-muted" v-if="live == -1 || live == 1">{{ duration }}</span>
        <div class="tarja" v-if="live == 0">
            <div class="spinner-grow spinner-grow-sm dot" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span>Ao vivo</span>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: {
        dt_inicio: {
            type: String,
            default: null
        },
        dt_fim: {
            type: String,
            default: null
        }
    },
    data:() => ({
        live: null,
        duration: null
    }),
    methods: {
        checkDate(){
            let hoje = moment();
            let inicio = moment(this.dt_inicio);
            let fim = moment(this.dt_fim);

            //ocorreu
            if(hoje > fim){
                this.live = -1;
                this.duration = 'Ocorreu '+moment(this.dt_fim).startOf('second').fromNow();
            }

            //ocorrendo
            if(hoje >= inicio && hoje < fim){
                this.live = 0;
            }

            //agendado
            if(hoje < inicio){
                this.live = 1;
                this.duration = 'Começa '+moment(this.dt_inicio).startOf('second').fromNow();
            }
        }
    },
    mounted(){
        this.checkDate();

        setInterval(() => {
            this.checkDate();
        }, 1000);
    }
}
</script>