<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Artists</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 shadow w-96 2xl:w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]'"
                        bg="bg-white"
                        placeholder="Search for events, artists"
                        type="search"
                    />
                    <div class="relative" v-click-away="closeSort">
                        <Btn type="toggleDropdown"
                             text="Sort by"
                             @click="showSortBy = !showSortBy"
                             :open="showSortBy"/>
                        <CustomSelect
                            v-show="showSortBy"
                            :active="filter.sortOption"
                            :options="sortOptions"
                            :sortDirection="filter.order"
                            @selectOption="sortArtists"
                            :class="showSortBy ? 'rounded-b-md' : 'rounded-md'"
                        />
                    </div>
                </form>
            </div>
            <Btn type="create" @click="openModal = !openModal" />
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

        <div class="flex flex-wrap gap-3">
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
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import CustomSelect from "../../Components/Partials/CustomSelect";

export default {
    // included child components
    components: {
        CustomSelect,
        Input,
        Btn,
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
        request: Object,
    },
     // custom set
     data() {
        return {
            filter: this.$inertia.form({
                search: this.request.search,
                sortOption: this.request.sortOption ?? "",
                order: this.request.order,
            }),
            open: "",
            currentRoute: "",
            openModal: false,
            selectedButton: 'cards',
            sortOptions: {
                "name": "Name",
                "created_at": "Created",
            },
            showSortBy: false,
        };
    },
    // methods
    methods: {
        onClickAway(event) {
            this.open = "";
        },
        setSelectedButton(e){
            this.selectedButton = e;
        },
        submit() {
            this.filter.get(this.$route("admin::artists.index"));
        },
        sortArtists(e) {
            this.filter.sortOption = e;
            this.filter.order = this.filter.order === "asc" ? "desc" : "asc";
           this.submit();
        },
        closeSort(event) {
            this.showSortBy = false;
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
