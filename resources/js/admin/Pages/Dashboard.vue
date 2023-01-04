<template>
    <DefaultLayout>
        <div v-if="chartLoading">Loader...</div>
        <LineChart
            :chartData="chartData"
            v-else
        />
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../Layouts/DefaultLayout";
import moment from 'moment'
import { Line } from 'vue-chartjs'
import LineChart from "../Components/LineChart";
import axios from "axios";

export default {
    // included child components
    components: {
        LineChart,
        DefaultLayout,

    },
    // passed from controller
    props: {
        dates: Object,
    },
    data() {
        return {
            chartLoading: true,
            chartData: null,
        };
    },
    mounted() {
        this.loadChartData();
    },
    methods: {
        loadChartData() {
            axios
                .get(this.$route('admin::dashboard.get-chart-data'))
                .then(response => {
                    this.chartData = response.data;
                    this.chartLoading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
};
</script>
