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
            <span class="text-primary font-semibold"> venues</span> <span></span>
        </p>
<!--        <form @submit.prevent="submit">
            <Input  v-model="filter.search" />

        </form>-->
        <div class="flex flex-wrap gap-5">
            <div class="grid gap-4 grid-cols-7 items-center col-span-1 px-12 text-sm bg-white w-full h-24 rounded-2xl shadow-[0px_8px_21px_rgba(0,0,0,0.25)] cursor-pointer transition duration-500 hover:scale-[1.01]" v-for="venue in venues">
                <h2 class="col-span-1 font-semibold text-base">{{ venue.id }}</h2>
                <h3 class="col-span-2 font-semibold text-primary">{{ venue.name }}</h3>
                <p class="col-span-1 text-center text-xs">{{ venue.city }}</p>
                <p class="col-span-2 text-center text-xs">{{venue.country}}</p>
               <Link class="" :href="$route('venues.edit', { venue: venue.id, })" >
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
