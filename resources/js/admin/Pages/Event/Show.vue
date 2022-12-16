<template>
    <DefaultLayout currentRoute="events">
        <div class="flex flex-col min-w-[350px] h-full">
            <div class="flex justify-between">
                <div class="flex items-center mb-5">
                    <h2 class="font-bold text-2xl capitalize">
                        {{ event.title }}
                    </h2>
                </div>
            </div>
            <div class="w-full max-w-6xl z-10 flex flex-row gap-6 grid grid-cols-3">
                <div class="col-span-2">
                    <ul class="flex flex-row gap-2.5 z-0">
                        <Tab type="dates" text="Dates & Venues" @tabClick="this.activeTab = 'dates'" :activeTab="activeTab" />
                        <Tab type="seo" text="SEO" @tabClick="this.activeTab = 'seo'" :activeTab="activeTab" />
                    </ul>
                {{event.dates}}
                <div v-if="event.dates.length" v-for="date in event.dates" class="relative mt-[-10px] 2xl:h-[550px] xl:h-[450px] overflow-scroll bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                        <div v-show="activeTab === 'dates'" class="absolute top-0 left-0 h-full w-full p-10 flex flex-col gap-4">
                            <div v-for="date in event.dates" class="px-6 py-3 bg-white-secondary items-center justify-between flex h-[100px] w-full rounded-md">
                                <div class="flex">
                                    <div class="flex flex-col gap-0.5 mr-6 items-center">
                                        <p class="uppercase text-sm">{{ $date(date.date, 'MMM') }}</p>
                                        <p class="text-2xl font-bold">{{ $date(date.date, 'DD') }}</p>
                                        <p class="text-xs">{{ $date(date.date, 'YYYY') }}</p>
                                    </div>


                                    <div  class="self-start flex flex-col gap-1">
                                        <p class="text-sm">{{ $date(date.date, 'dddd') }} {{ $time(date.date) }} - 15:00</p>
                                        <p class="text-xs">{{ date.venue.country }}</p>
                                    </div>
                                </div>
                                <div class="bg-success text-success-bg font-semibold px-6 py-1 min-w-28 rounded-full flex items-center justify-center">{{ date.status }}</div>
                            </div>
                        </div>
                        <div v-show="activeTab === 'seo'" class="absolute top-0 left-0 h-full w-full p-10 flex flex-col gap-7">
                            <div>
                                <label class="text-xs text-g mb-2">SEO Title</label>
                                <p>{{ event.seo_title }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-g mb-2">SEO Description</label>
                                <p>{{ event.seo_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 relative mt-[34px] 2xl:h-[550px] xl:h-[450px] p-5 bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                    <img alt="" class="rounded-lg h-48 w-full" src="/images/nikolaj_stokholm.jpg"/>
                    <div class="p-3 pt-5 pt-1 flex flex-row justify-between">
                        <div>
                            <h2 class="font-bold text-xl">{{ event.title }}</h2>
                            <h3 class="text-gray-400 text-sm">{{ event.sub_title }}</h3>
                        </div>
                    </div>
                    <div class="px-3">
                        <p class="font-sm"> by
                            <Link v-for="artist in event.artists" class="text-primary font-bold hover:underline" :href="$route('admin::artists.show', { artist: artist.id })">{{artist.name}}</Link>
                        </p>
                        <p class="text-sm xl:mb-5 2xl:mb-12">32 out of 32 events</p>

                            <div class="flex justify-between">
                                <div>
                                    <label class="text-xs">Start Date</label>
                                    <p>
                                        {{ $date(event.sale_start) }}
                                    </p>
                                    <p class="text-sm">
                                        {{ $time(event.sale_start) }}
                                    </p>
                                </div>
                                <div class="self-center">-</div>
                                <div>
                                    <label class="text-xs">End Date</label>
                                    <p>
                                        {{ $date(event.sale_end) }}
                                    </p>
                                    <p class="text-sm">
                                        {{ $time(event.sale_end) }}
                                    </p>
                                </div>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import Modal from "../../Components/Modal";
import { directive } from "vue3-click-away";
import Tab from "../../Components/Partials/Tab";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Tab,
        DefaultLayout,
        Modal,
        Link,
    },
    props: {
        event: Object,
    },
    data() {
        return {
            open: false,
            openModal: false,
            activeTab: 'dates',
            activeTabContent: false,
            endTime: ''
        }
    },
    mounted() {

    },
    methods: {
        onClickAway(artist) {
            this.open = false;

        },


    },
    directives: {
        ClickAway: directive,
    }
}
</script>
