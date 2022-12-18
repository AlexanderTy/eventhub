<template>
    <DefaultLayout currentRoute="events">
        <div class="flex flex-col min-w-[350px] h-full">
            <div class="flex justify-between max-w-6xl">
                    <h2 class="font-bold text-2xl capitalize">
                        {{ event.title }}
                    </h2>
                <LinkBtn class="mt-5"
                         :type="'edit'"
                         :href="$route('admin::events.edit', {event:event.id})"/>
            </div>
            <div class="w-full max-w-6xl z-10 flex flex-row gap-6 grid grid-cols-3">
                <div class="col-span-2">
                    <ul class="flex flex-row gap-2.5 z-0">
                        <Tab type="dates" text="Dates & Venues" @tabClick="this.activeTab = 'dates'" :activeTab="activeTab" />
                        <Tab type="seo" text="SEO" @tabClick="this.activeTab = 'seo'" :activeTab="activeTab" />
                    </ul>
                <div class="relative mt-[-10px] 2xl:h-[550px] h-[450px] overflow-scroll bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                        <div v-show="activeTab === 'dates'" class="absolute top-0 left-0 h-full w-full p-10 flex flex-col gap-4">
                            <div v-for="date in event.dates" class="px-6 py-3 bg-white-secondary items-center justify-between flex h-[100px] w-full rounded-md">
                                <div class="flex">
                                    <div class="flex flex-col gap-0.5 mr-6 items-center">
                                        <p class="uppercase text-sm">{{ $date(date.date, 'MMM') }}</p>
                                        <p class="text-2xl font-bold">{{ $date(date.date, 'DD') }}</p>
                                        <p class="text-xs">{{ $date(date.date, 'YYYY') }}</p>
                                    </div>


                                    <div  class="self-start flex flex-col gap-1">
                                        <p class="text-sm">{{ $date(date.date, 'dddd') }} {{ $time(date.date) }} - {{ $calcEndTime(date.date, date.duration) }}</p>

<!--                                        <h3 class="font-semibold text-xl">{{ date.venue.name }} - {{ date.venue.city }}</h3>-->
<!--                                        <p class="text-xs">{{ date.venue.country }}</p>-->
                                    </div>
                                </div>
                                <div v-show="date.status"
                                    class="capitalize font-medium px-6 py-2 w-[130px] rounded-full flex items-center justify-center"
                                     :class="{'text-success-secondary bg-success-primary' : date.status === 'available', 'text-white-secondary bg-tertiary' : date.status === 'premier', 'text-preview-secondary bg-preview-primary' : date.status === 'preview', 'text-extra-secondary bg-extra-primary' : date.status === 'extra', 'text-warning-secondary bg-warning-primary' : date.status === 'few tickets', 'text-error-secondary bg-error-primary' : date.status === 'sold out'}"

                                >{{ date.status }}</div>
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
                <div class="col-span-1 relative overflow-scroll mt-[34px] 2xl:h-[550px] h-[450px] p-5 bg-white rounded-md shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                    <div class="relative">
                        <img v-if="event.image" alt="" class="rounded-lg h-48 w-full" :src="'/images/artists/' + event.image"/>
                        <div v-else class="rounded-lg h-48 w-full bg-tab-secondary text-white flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-28 h-28">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute top-3 right-3 self-end">
                            <PublishedStatus :status="event.public" />
                        </div>
                    </div>

                    <div class="p-3 pt-5 pt-1 flex flex-row justify-between">
                        <div>
                            <h2 class="font-bold text-xl">{{ event.title }}</h2>
                            <h3 class="text-gray-400 text-sm">{{ event.sub_title }}</h3>
                        </div>
                    </div>
                    <div class="px-3 min-h-[154px] 2xl:h-[254px] flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm">
                                by
                                <span v-for="(artist, index) in event.artists">
                            <Link :href="$route('admin::artists.show', { artist: artist.id })"
                                  class="text-primary font-bold hover:underline">
                                {{ artist.name }}
                            </Link>
                            <span v-if="index + 1 < event.artists.length">, </span>
                        </span>
                            </h3>
                           <DatesStatus :dates="event.dates" :length="'long'"/>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <label class="text-xs">Sale Start</label>
                                <p>
                                    {{ $date(event.sale_start) }}
                                </p>
                                <p class="text-sm">
                                    {{ $time(event.sale_start) }}
                                </p>
                            </div>
                            <div class="self-center">-</div>
                            <div>
                                <label class="text-xs">Sale End</label>
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
import PublishedStatus from "../../Components/Partials/PublishedStatus";
import moment from "moment";
import LinkBtn from "../../Components/Partials/LinkBtn";
import DatesStatus from "../../Components/Partials/DatesStatus";

export default {
    components: {
        DatesStatus,
        LinkBtn,
        PublishedStatus,
        Tab,
        DefaultLayout,
        Modal,
        Link,
        moment,
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
            endTime: '',
            testDuration: '',
            datesLeft: 0,
        }
    },
    mounted() {
        this.calcDatesLeft();
    },
    methods: {
        onClickAway(artist) {
            this.open = false;
        },
        calcDatesLeft() {
            this.event.dates.forEach(date => {
                //check if date is in the past then add to datesLeft
                if (new Date(date.date) > new Date()) {
                    this.datesLeft++;
                }
            })
        },
    },
    directives: {
        ClickAway: directive,
    }
}
</script>
