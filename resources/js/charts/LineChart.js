import { Line } from 'vue-chartjs';

export default {
    extends: Line,
    props: {
        chartdata: {
            type: Object,
            default: null
        },
        options: {
            type: Object
        }
    },
    mounted () {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        if(this.chartdata != null){
            this.renderChart(this.chartdata, this.options)
        }
    }
}