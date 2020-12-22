<template>
<div>
    <date-picker
        ref="calendar"
        :input-props='{
            readonly: true,
            name: name,
            required: true,
            class: className
        }'
        :value="date"
        :popover="{ visibility: 'click' }" />
        
        <span class="invalid-feedback d-table" role="alert" v-if="errorMessage != ''">
            <strong>{{ errorMessage }}</strong>
        </span>
</div>
</template>

<script>
import moment from 'moment';
import DatePicker from 'v-calendar/lib/components/date-picker.umd';
export default {
    props: {
        value: {
            type: String,
            default: null
        },
        name: {
            type: String,
            default: ''
        },
        className: {
            type: String,
            default: ''
        },
        errorMessage: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    components: {
        DatePicker
    },
    data: () => ({
        date: new Date()
    }),
    mounted(){
        if(this.value != null) this.date = moment(this.value).toDate();
    }
}
</script>