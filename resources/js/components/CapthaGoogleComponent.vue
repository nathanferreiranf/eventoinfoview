<template>
    <vue-recaptcha 
        ref="recaptcha"
        @verify="onVerify"
        @expired="onExpired"
        :sitekey="sitekey" 
    ></vue-recaptcha>
</template>
 
<script>
    import VueRecaptcha from 'vue-recaptcha';
    export default {
        props: {
            sitekey: {
                type: String,
                default: ''
            }
        },
        components: { VueRecaptcha },
        methods: {
            onVerify: function (response) {
                this.$refs.inputRecaptcha.value = response;
            },
            onExpired: function () {
                console.log('Expired')
            },
            resetRecaptcha () {
                this.$refs.recaptcha.reset() // Direct call reset method
            }
        }
    }
</script>