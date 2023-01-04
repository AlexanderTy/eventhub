<template>
    <Line
        id="my-chart-id"
        :options="chartOptions"
        :data="chartData"
    />
</template>

<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, PointElement, LineElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, PointElement, LineElement, CategoryScale, LinearScale)

export default {
    components: { Line },
    props: {
        chartData: Object,
    },
    data() {
        return {
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
