<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Events</h1>
            <button @click="openModal = !openModal">Create</button>
            <Teleport to="#app">
                <CreateModal v-show="openModal" @close-modal="openModal = false"/>
            </Teleport>
        </div>
        <p class="mb-8">
            We've found
            <span class="text-primary font-semibold">{{ artists.length }} </span> <span> {{ artists.length === 1 ? "artist" : "artists" }}</span>
        </p>
        <div class="flex flex-wrap gap-5">
            <ArtistCard :artist="artist" v-for="artist in artists" />

            <div class="w-full px-12 grid gap-4 grid-cols-7 text-xs">
                <p class="col-span-2">Title</p>
                <p class="col-span-1">Artist</p>
                <p class="col-span-1 text-center">Events</p>
                <p class="col-span-1 text-center">Sale date (start)</p>
                <p class="col-span-1 text-center">Sale date (end)</p>
                <p class="col-span-1 text-center">Public</p>
            </div>
            <div class="grid gap-4 grid-cols-7 items-center col-span-1 px-12 text-sm bg-white w-full h-24 rounded-2xl shadow-[0px_8px_21px_rgba(0,0,0,0.25)] cursor-pointer transition duration-500 hover:scale-[1.01]" v-for="event in events">
                <h2 class="col-span-2 font-semibold text-base">{{ artist.name }}</h2>
                <h3 class="col-span-1 font-semibold text-primary">{{ artist.name }}</h3>
                <p class="col-span-1 text-center">32/32</p>
                <div>
                    <p class="col-span-1 text-center text-xs">{{ artist.name }}</p>
                    <p class="col-span-1 text-center text-xs">7:00 AM</p>
                </div>
                <div>
                    <p class="col-span-1 text-center text-xs">{{ artist.name }}</p>
                    <p class="col-span-1 text-center text-xs">12:00 PM</p>
                </div>
                <div v-show="status" class="col-span-1 justify-self-center text-xs h-7 w-28 bg-success-bg flex justify-center items-center rounded-full">
                    <p class="text-success font-bold">Published</p>
                </div>
                <div v-show="!status" class="col-span-1 justify-self-center text-xs h-7 w-28 bg-error-bg flex justify-center items-center rounded-full">
                    <p class="text-error font-bold">Not published</p>
                </div>
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
import ArtistCard from "../../Components/Partials/ArtistCard";

export default {
    // included child components
    components: {
        ArtistCard,
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        artists: Object,
        status: Boolean,
    },
     // custom set
     data() {
        return {
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
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
