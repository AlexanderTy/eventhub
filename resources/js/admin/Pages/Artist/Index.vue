<template>
    <DefaultLayout currentRoute="artists">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Artists</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 w-96 2xl:w-[484px] h-9'"
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
                <CreateModal v-if="openModal" @close-modal="openModal = false" type="artist" label="Create new artist" />
            </Teleport>
        </div>

        <div class="flex flex-row w-full justify-between mb-4 text-gray-600">
            <p class="">
                We've found
                <span class="text-primary font-semibold">{{ artists.length }} </span> <span> {{ artists.length === 1 ? "artist" : "artists" }}</span>
            </p>
            <DisplayButtons @btnClick="(n) => selectedButton = n"/>

        </div>

        <div class="flex flex-wrap gap-4">
            <ArtistCard
                :artist="artist"
                v-for="artist in artists"
                v-if="selectedButton ==='cards' " />
        </div>

        <div v-if="selectedButton === 'list'" class="flex flex-col">
            <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div class="md:rounded-lg">
                        <table
                            class="min-w-full divide-y divide-white-secondary"
                        >
                            <thead class="bg-white bg-opacity-50">
                            <tr>
                                <th
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                    scope="col"
                                >
                                    Image
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Artist
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Short Description
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Total Events
                                </th>
                                <th
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                    scope="col"
                                >
                                    <span class="sr-only">Settings</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-white-secondary bg-white"
                            >
                            <ArtistList v-if="selectedButton === 'list' " :artist="artist" v-for="artist in artists"   />
                            </tbody>
                        </table>
                    </div>
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
            selectedButton: this.$page.props.profile.settings?.displayBtns ?? 'cards',
            sortOptions: {
                "name": "Name",
                "created_at": "Created",
            },
            showSortBy: false,
            previousSortOption: "",
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
            this.previousSort = this.filter.sortOption;
            this.filter.sortOption = e;

            // check if current sort is the same as the previous sort
            if (this.filter.sortOption === this.previousSort) {
                // check if previous sort direction was descending
                if (this.filter.order === 'desc') {
                    // set sort direction to ascending
                    this.filter.order  = 'asc';
                    console.log("yo")
                } else {
                    // toggle sort direction
                    this.filter.order = this.filter.order === 'asc' ? 'desc' : 'asc';
                }
            } else {
                // set sort direction to ascending (default)
                this.filter.order = 'asc';
            }

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
