<template>
    <DefaultLayout currentRoute="events">
        <div class="flex gap-8 mb-8">
            <h1 class="font-bold text-3xl">Events</h1>
            <form @submit.prevent="submit" class="">
                <Input type="search" placeholder="Search for events, artists" v-model="filter.search" bg="bg-white" :class="'shadow w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]' "/>
                <select v-model="filter.filter" @update:modelValue="submit" class="shadow w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]">
                    <option value="">All</option>
                    <option value="public">Public</option>
                </select>

            </form>
            <Btn type="create" @click="openModal = !openModal">
                Create
            </Btn>
            <Teleport to="#app">
                <CreateModal v-show="openModal" @close-modal="openModal = false"/>
            </Teleport>
        </div>

        <div class="flex flex-row w-full justify-between mb-8 text-gray-600">
            <p>
                We've found
                <span class="text-primary font-semibold">{{ events.length }} </span> <span> {{ events.length === 1 ? "event" : "events" }}</span>
            </p>

            <DisplayButtons @btnClick="setSelectedButton"/>
        </div>




        <div class="flex flex-wrap gap-3">
            <EventCard :event="event" v-for="event in events" v-show="selectedButton === 'cards'"/>
            <div v-show="selectedButton === 'list'" class="w-full px-12 grid gap-4 grid-cols-[repeat(17,_minmax(0,_1fr))] text-xs">
                <p class="col-span-4">Event</p>
                <p class="col-span-3 text-center">Dates</p>
                <p class="col-span-3 text-center">Sale date (start)</p>
                <p class="col-span-3 text-center">Sale date (end)</p>
                <p class="col-span-3 text-center">Public</p>
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
import DisplayButtons from "../../Components/Partials/DisplayButtons";

export default {
    // included child components
    components: {
        DisplayButtons,
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
                filter: this.request.filter,
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
        },
        submit() {
            this.filter.get(this.$route('events.index'));
        },
        setSelectedButton(e){
            this.selectedButton = e;
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
