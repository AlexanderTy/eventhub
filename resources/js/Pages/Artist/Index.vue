<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Artists</h1>
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

            <div class="w-full px-12 grid text-xs">
                <p class="">Image</p>
                <p class="">Artist</p>
                <p class="">Short Description</p>
                <p class="">Events</p>
            </div>

            <ArtistList :artist="artist" v-for="artist in artists" />

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
import ArtistList from "../../Components/Partials/ArtistList";

export default {
    // included child components
    components: {
        ArtistList,
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
