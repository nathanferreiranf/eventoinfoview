<template>
    <div>
        <money class="form-control" v-model="price" v-bind="money"></money> 
        <input type="hidden" name="vl_plano" :value="price" />
    </div>
</template>

<script>
  import {Money} from 'v-money'

  export default {
    props: {
        value: {
            type: Number,
            default: 0
        }
    },
    components: {Money},
    data () {
        return {
            price: 0,
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
                masked: false
            }
        }
    },
    methods: {
        updateValue(value){
            this.$refs.input.value = value;
        }
    },
    mounted(){
        this.price = this.value;
    }
}
</script>