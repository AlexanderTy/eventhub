<template>
    <DefaultLayout type="tabpage">
        <div class="grid grid-cols-6 gap-4 h-full overflow-hidden">
            <div class="bg-white p-2 col-span-4">
                <div v-if="chartLoading">Loader...</div>
                <LineChart
                    v-else
                    :chartData="chartData"
                    class="w-full"
                />
            </div>
            <div class="col-span-2 bg-white">
                <h2 class="px-4 py-4 font-bold text-xl">Upcoming dates</h2>

                <Link v-for="date in upcomingDates"
                      :href="$route('admin::events.show', { event: date.event.id })"
                      class=" m-2 bg-white-secondary  h-24 rounded-md grid grid-cols-3">
                    <img v-if="date.event.image" :src="'/images/events/' + date.event.image" alt=""
                         class="rounded-l-md h-24 w-full col-span-1 object-cover"/>
                    <div v-else
                         class="rounded-l-md h-24 w-full col-span-1 bg-tab-secondary text-white flex justify-center items-center">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="col-span-2 py-3 pl-3 pr-2 flex flex-col justify-between">
                        <div class="flex flex-row justify-between">
                            <Link :href="$route('admin::events.show', { event: date.event.id })"
                                  class="font-semibold cursor-pointer hover:underline">{{ date.event.title }}
                            </Link>


                        </div>

                        <p class="text-sm 2xl:pt-2 flex items-center">
                            <svg class="w-4 h-4 text-tab-secondary mr-1 " fill="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                      fill-rule="evenodd"/>
                            </svg>
                            {{ $date(date.date, 'ddd, DD. MMM YY HH:mm') }}
                        </p>
                    </div>

                </Link>
            </div>
            <div class="col-span-2 bg-white">
                <h2 class="px-4 py-4 font-bold text-xl">Recently created events </h2>

                <Link v-for="event in recentlyCreatedEvents"
                      :href="$route('admin::events.show', { event: event.id })"
                      class=" m-2 bg-white-secondary  h-24 rounded-md grid grid-cols-3">
                    <img v-if="event.image" :src="'/images/events/' + event.image" alt=""
                         class="rounded-l-md h-24 w-full col-span-1 object-cover"/>
                    <div v-else
                         class="rounded-l-md h-24 w-full col-span-1 bg-tab-secondary text-white flex justify-center items-center">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="col-span-2 py-3 pl-3 pr-2 flex flex-col justify-between">
                        <div class="flex flex-row justify-between">
                            <Link :href="$route('admin::events.show', { event: event.id })"
                                  class="font-semibold cursor-pointer hover:underline">{{ event.title }}
                            </Link>


                        </div>
                        <h3 v-if="event.artists>0" :class="event.artists.length >= 4 ? 'text-sm' : event.artists.length >= 2 ? 'text-xs' : 'text-sm'"
                            class="text-sm">
                            by
                            <span v-for="(artist, index) in event.artists" v-show="event.artists.length < 4">
                            <Link :href="$route('admin::artists.show', { artist: artist.id })"
                                  class="text-primary font-bold hover:underline">
                                {{ artist.name }}
                            </Link>
                            <span v-if="index + 1 < event.artists.length">, </span>
                        </span>
                            <span v-show="event.artists?.length >= 4">
                                <span class="text-primary font-bold">{{ event.artists.length }}</span> different artists
                            </span>
                        </h3>
                    </div>

                </Link>
            </div>
            <div class="col-span-2 bg-white h-full overflow-scroll">
                <h2 class="px-4 py-4 font-bold text-xl">Last updated events </h2>
                <Link v-for="event in lastUpdatedEvents"
                      :href="$route('admin::events.show', { event: event.id })"
                      class=" mx-4 my-2 bg-white-secondary  h-24 rounded-md grid grid-cols-3">
                    <img v-if="event.image" :src="'/images/events/' + event.image" alt=""
                         class="rounded-l-md h-24 w-full col-span-1 object-cover"/>
                    <div v-else
                         class="rounded-l-md h-24 w-full col-span-1 bg-tab-secondary text-white flex justify-center items-center">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="col-span-2 py-3 pl-3 pr-2 flex flex-col justify-between">
                        <div class="flex flex-row justify-between">
                            <Link :href="$route('admin::events.show', { event: event.id })"
                                  class="font-semibold cursor-pointer hover:underline">{{ event.title }}
                            </Link>


                        </div>
                        <h3 v-if="event.artists.length>0" :class="event.artists.length >= 4 ? 'text-sm' : event.artists.length >= 2 ? 'text-xs' : 'text-sm'"
                            class="text-sm">
                            by
                            <span v-for="(artist, index) in event.artists" v-show="event.artists.length < 4">
                            <Link :href="$route('admin::artists.show', { artist: artist.id })"
                                  class="text-primary font-bold hover:underline">
                                {{ artist.name }}
                            </Link>
                            <span v-if="index + 1 < event.artists.length">, </span>
                        </span>
                            <span v-show="event.artists.length >= 4">
                            <span class="text-primary font-bold">{{ event.artists.length }}</span> different artists
                        </span>
                        </h3>
                    </div>

                </Link>
            </div>
        </div>
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../Layouts/DefaultLayout";
import LineChart from "../Components/LineChart";
import axios from "axios";
import EventCardSmall from "../Components/Partials/EventCardSmall";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    // included child components
    components: {
        EventCardSmall,
        LineChart,
        DefaultLayout,
        Link,

    },
    // passed from controller
    props: {
        dates: Object,
        upcomingDates: Object,
        recentlyCreatedEvents: Object,
        lastUpdatedEvents: Object,
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
