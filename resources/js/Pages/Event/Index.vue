<template>
    <DefaultLayout currentRoute="events">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Events</h1>
            <Btn type="create" @click="openModal = !openModal">Create</Btn>
            <Teleport to="#app">
                <CreateModal v-show="openModal" @close-modal="openModal = false"/>
            </Teleport>
        </div>

        <form @submit.prevent="submit" class="mb-20">
            <Input type="search" placeholder="Search for events, artists" v-model="filter.search" bg="bg-white" :class="'shadow w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]' "/>
        </form>

        <div class="flex flex-row w-full justify-between mb-8 text-gray-600">
            <p>
                We've found
                <span class="text-primary font-semibold">{{ events.length }} </span> <span> {{ events.length === 1 ? "event" : "events" }}</span>
            </p>
            <div class="flex flex-row items-center gap-2.5">
                <button @click="selectedButton = 'cards'"  :class="selectedButton === 'cards' ? 'text-primary' : 'text-gray-600'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 18" fill="currentColor" class="w-5 h-5">
                        <rect fill-rule="evenodd" y="10" width="6" height="8" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" x="8" y="10" width="6" height="8" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" x="16" y="10" width="6" height="8" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" x="16" width="6" height="8" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" x="8" width="6" height="8" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" width="6" height="8" clip-rule="evenodd"/>
                    </svg>
                </button>
                <button @click="selectedButton = 'list'"  :class="selectedButton === 'list' ? 'text-primary' : 'text-gray-600'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 15" fill="currentColor" class="w-5 h-5" >
                        <rect fill-rule="evenodd" width="20" height="3" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" y="6" width="20" height="3" clip-rule="evenodd"/>
                        <rect fill-rule="evenodd" y="12" width="20" height="3" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>




        <div class="flex flex-wrap gap-5">
            <EventCard :event="event" v-for="event in events" v-show="selectedButton === 'cards'"/>
            <div v-show="selectedButton === 'list'" class="w-full px-12 grid gap-4 grid-cols-[repeat(17,_minmax(0,_1fr))] text-xs">
                <p class="col-span-4">Title</p>
                <p class="col-span-2">Artist</p>
                <p class="col-span-2 text-center">Events</p>
                <p class="col-span-3 text-center">Sale date (start)</p>
                <p class="col-span-3 text-center">Sale date (end)</p>
                <p class="col-span-2 text-center">Public</p>
            </div>
            <EventList :event="event" v-for="event in events" v-show="selectedButton === 'list'" />
        </div>


    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "../../Components/Partials/PublishedStatus";
import { Link } from "@inertiajs/inertia-vue3";
import CreateModal from "../../Components/CreateModal";
import {directive} from "vue3-click-away";
import EventCard from "../../Components/Partials/EventCard";
import Input from "../../Components/Partials/Input";
import EventList from "../../Components/Partials/EventList";
import Btn from "../../Components/Partials/Btn";

export default {
    // included child components
    components: {
        Btn,
        EventList,
        Input,
        EventCard,
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        events: Object,
        status: Boolean,
        request: Object,
        type: String,

    },
     // custom set
     data() {
        return {
            filter: this.$inertia.form({
                search: this.request.search,
            }),
            open: "",
            currentRoute: "",
            openModal: false,
            selectedButton: 'cards',
        };
    },
    // methods
    methods: {
        onClickAway(event) {
            this.open = "";
            console.log("penis")
        },
        submit() {
            this.filter.get(this.$route('events.index'));
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
