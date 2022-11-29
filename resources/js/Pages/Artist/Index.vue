<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Artists</h1>
            <button @click="openModal = !openModal">Create</button>
            <Teleport to="#app">
                <CreateModal v-show="openModal" @close-modal="openModal = false"/>
            </Teleport>
        </div>

        <div class="flex flex-row w-full justify-between mb-8 text-gray-600">
        <p class="">
            We've found
            <span class="text-primary font-semibold">{{ artists.length }} </span> <span> {{ artists.length === 1 ? "artist" : "artists" }}</span>
        </p>
        <DisplayButtons @btnClick="setSelectedButton"/>
        </div>

        <div class="flex flex-wrap gap-5">
            <ArtistCard :artist="artist" v-for="artist in artists" v-show="selectedButton === 'cards'" />

            <div class="grid gap-4 grid-cols-[repeat(18,_minmax(0,_1fr))] w-full px-12 grid text-xs" v-show="selectedButton === 'list'">
                <p class="col-span-2">Image</p>
                <p class="col-span-5">Artist</p>
                <p class="col-span-7">Short Description</p>
                <p class="col-span-3 text-center">Events</p>
            </div>

            <ArtistList :artist="artist" v-for="artist in artists" v-show="selectedButton === 'list'" />

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
import DisplayButtons from "../../Components/Partials/DisplayButtons";

export default {
    // included child components
    components: {
        DisplayButtons,
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
            selectedButton: 'cards',
        };
    },
    // methods
    methods: {
        onClickAway(event) {
            this.open = "";
        },
        setSelectedButton(e){
            this.selectedButton = e;
        }
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
