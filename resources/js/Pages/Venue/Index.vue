<template>
    <DefaultLayout currentRoute="venues">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Venues</h1>
            <button @click="openModal = !openModal">Create</button>
            <Teleport to="#app">
                <CreateModal v-show="openModal" @close-modal="openModal = false"/>
            </Teleport>
        </div>
        <p class="mb-8">
            We've found
            <span class="text-primary font-semibold"> {{ venues.length }} </span> <span> {{ venues.length === 1 ? "venue" : "venues" }}</span>
        </p>
<!--        <form @submit.prevent="submit">
            <Input  v-model="filter.search" />

        </form>-->


        <div class="flex flex-wrap gap-3">
            <div class="grid gap-4 grid-cols-7 text-xs items-center px-12 w-full">
                <p class="col-span-2">Name</p>
                <p class="col-span-2">Address</p>
                <p class="col-span-2">Country</p>
            </div>
            <div class="grid gap-4 grid-cols-7 text-sm items-center col-span-1 px-12 bg-white w-full h-16 rounded-2xl shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)] cursor-pointer transition duration-500 hover:scale-[1.01]"
                 v-for="venue in venues">
                <h2 class="col-span-2 font-semibold text-lg">{{ venue.name }}</h2>
                <div class="col-span-2">
                    <p class="capitalize">{{ venue.address }}</p>
                    <p>{{ venue.zipcode }} {{ venue.city }}</p>
                </div>
                <p class="col-span-2 capitalize">{{venue.country}}</p>
               <Link class="col-span-1" :href="$route('venues.edit', { venue: venue.id, })" >
                   Edit
               </Link>
            </div>

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

export default {
    // included child components
    components: {
        Input,
        EventCard,
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        venues: Object,
        request: Object,

    },
     // custom set
     data() {
        return {
          /*  filter: this.$inertia.form({
                search: this.request.search,
            }),*/
            open: "",
            currentRoute: "",
            openModal: false,
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
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
