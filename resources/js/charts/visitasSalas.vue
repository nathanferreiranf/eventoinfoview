<template>
    <line-chart v-if="datacollection.datasets != null" :chartdata="datacollection" :options="options"></line-chart>
</template>

<script>
    import moment from 'moment';
    import LineChart from './LineChart.js'

    export default {
        components: {
            LineChart
        },
        props: {
            periodo: {
                type: Array,
                default: []
            },
            salas: {
                type: Array,
                default: null
            }
        },
        data () {
            return {
                datacollection: {
                    labels: [],
                    datasets: null
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Visitas por salas'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {if (value % 1 === 0) {return value;}}
                            }
                        }]
                    }
                }
            }
        },
        methods: {
            randomRgba() {
                let o = Math.round, r = Math.random, s = 255;
                return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',0.4)';
            }
        },
        mounted () {
            moment.locale('pt-BR');

            if(this.periodo.length){
                let periodo = this.periodo.map(({dia}) => moment(dia).format('DD/MMM'));
                this.datacollection.labels = periodo;
            }

            if(this.salas != null){
                let data = [];

                this.salas.forEach((sala, index) => {
                    data.push({
                        label: sala.nm_sala,
                        backgroundColor: this.randomRgba(),
                        data: sala.periodo
                    });
                });

                this.datacollection.datasets = data;
            }
        }
    }
</script>