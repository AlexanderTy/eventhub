<template>
    <p v-if="length === 'long'" class="text-sm 2xl:pt-2">
        {{ this.datesLeft }} out of {{ dates.length }} upcoming dates left
    </p>
    <p v-else class="text-sm 2xl:pt-2">
        {{ this.datesLeft }} out of {{ dates.length }} upcoming dates
    </p>
</template>

<script>
export default {
    props: {
        dates: Object,
        length: String,
    },
    data() {
        return {
            datesLeft: 0,
        }
    },
    mounted() {
        this.calcDatesLeft();
    },
    methods: {
        calcDatesLeft(){
            this.dates.forEach(date =>{
                if(new Date(date.date) > new Date()) {
                    this.datesLeft++;
                }
            })
        }

    },
}
</script>

<style scoped>

</style>
