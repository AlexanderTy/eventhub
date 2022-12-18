<template>
    <DefaultLayout currentRoute="venues">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Venues</h1>
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
                            @selectOption="sortVenues"
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
        <p class="mb-4 text-gray-600">
            We've found
            <span class="text-primary font-semibold"> {{ venues.length }} </span> <span> {{ venues.length === 1 ? "venue" : "venues" }}</span>
        </p>

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
               <Link class="col-span-1 justify-self-center" :href="$route('admin::venues.edit', { venue: venue.id, })" >
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
import Btn from "../../Components/Partials/Btn";
import CustomSelect from "../../Components/Partials/CustomSelect";

export default {
    // included child components
    components: {
        CustomSelect,
        Btn,
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
            filter: this.$inertia.form({
                search: this.request.search,
                sortOption: this.request.sortOption ?? "",
                order: this.request.order,
            }),
            open: "",
            currentRoute: "",
            openModal: false,
            showSortBy: false,
            sortOptions:{
                "name": "Name",
                "address": "Address",
                "country": "Country",

            },
        }
    },
    // methods
    methods: {
        onClickAway(event) {
            this.open = "";
        },
        submit() {
            this.filter.get(this.$route('admin::venues.index'));
        },
        closeSort(event) {
            this.showSortBy = false;
        },
        sortVenues(option) {
            this.filter.sortOption = option;
            this.filter.order = this.filter.order === "asc" ? "desc" : "asc";
            this.submit();
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
