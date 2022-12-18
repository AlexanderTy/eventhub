<template>
    <DefaultLayout currentRoute="events">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Events</h1>
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
                            @selectOption="sortEvents"
                            :class="showSortBy ? 'rounded-b-md' : 'rounded-md'"
                        />
                    </div>

                    <div class="relative" v-click-away="closeFilter">
                        <Btn type="toggleDropdown"
                             text="Filter"
                             @click="showFilter = !showFilter"
                             :open="showFilter"/>
                        <select
                            v-show="showFilter"
                            multiple
                            @change="updateFilter"
                            class="absolute z-20 w-full h-[165px] px-2 py-1 cursor-pointer bg-white shadow-[5px_20px_17px_-2px_rgba(0,0,0,0.15)]"
                            :class="showFilter ? 'rounded-b-md' : 'rounded-md'"
                        >
                            <option
                                class="flex gap-1.5 items-center my-6"
                                v-for="(value, key) in filterOptions"
                                :key="key"
                                :value="key"
                                :class="filter.filterArray.includes(key) ? 'text-primary font-semibold' : ''"
                            >{{ value }}</option>
                        </select>
                    </div>


                </form>
            </div>
            <Btn type="create" @click="openModal = !openModal" />
            <Teleport to="#app">
                <CreateModal
                    v-show="openModal"
                    @close-modal="openModal = false"
                />
            </Teleport>
        </div>
        <div class="flex flex-row w-full justify-between mb-4 text-gray-600">
            <p>
                We've found
                <span class="text-primary font-semibold">{{ events.length }}</span>
                <span>{{ events.length === 1 ? " event" : " events" }}</span>
            </p>

            <DisplayButtons @btnClick="setSelectedButton" />
        </div>
        <div class="flex flex-wrap gap-3">
            <EventCard
                v-for="event in events"
                v-show="selectedButton === 'cards'"
                :event="event"
            />
            <div
                v-show="selectedButton === 'list'"
                class="w-full px-12 grid gap-4 grid-cols-[repeat(17,_minmax(0,_1fr))] text-xs"
            >
                <p class="col-span-4">Event</p>
                <p class="col-span-3 text-center">Upcoming dates</p>
                <p class="col-span-3 text-center">Sale date (start)</p>
                <p class="col-span-3 text-center">Sale date (end)</p>
                <p class="col-span-3 text-center">Public</p>
            </div>
            <EventList
                v-for="event in events"
                v-show="selectedButton === 'list'"
                :event="event"
            />
        </div>
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "../../Components/Partials/PublishedStatus";
import { Link } from "@inertiajs/inertia-vue3";
import CreateModal from "../../Components/CreateModal";
import { directive } from "vue3-click-away";
import EventCard from "../../Components/Partials/EventCard";
import Input from "../../Components/Partials/Input";
import EventList from "../../Components/Partials/EventList";
import Btn from "../../Components/Partials/Btn";
import DisplayButtons from "../../Components/Partials/DisplayButtons";
import Select from "../../Components/Partials/Select";
import CustomSelect from "../../Components/Partials/CustomSelect";

export default {
    // included child components
    components: {
        CustomSelect,
        Select,
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
                sortOption: this.request.sortOption ?? "",
                order: this.request.order,
                filterArray: this.request.filterArray ?? [],
            }),
            open: "",
            currentRoute: "",
            openModal: false,
            showSortBy: false,
            showFilter: false,
            selectedButton: "cards",
            sortOptions: {
                "": "All",
                title: "Title",
                sale_start: "Sale start",
                sale_end: "Sale end",
                public: "Public",
                created_at: "Created",
            },
            filterOptions: {
                public: "Public",
                sale_start: "Sale started",
                sale_end: "Sale ended",
            },
            previousSort: '',

        };
    },
    mounted() {
        console.log(this.events);
    },
    // methods
    methods: {
        onClickAway(event) {
            this.open = "";
        },
        closeSort(event) {
            this.showSortBy = false;
        },
        closeFilter(event) {
            this.showFilter = false;
        },
        submit() {
            this.filter.get(this.$route("admin::events.index"));
        },
        setSelectedButton(e) {
            this.selectedButton = e;
        },
        sortEvents(e) {
            // check if clicked sort is the same as previous sort
            // set previous sort to current sort
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
        updateFilter(e){
            // check if the selected option is already in the filterArray
            if (this.filter.filterArray.includes(e.target.value)) {
                // remove the option from the filterArray
                this.filter.filterArray = this.filter.filterArray.filter((item) => item !== e.target.value);
            } else {
                // add the option to the filterArray
                this.filter.filterArray.push(e.target.value);
            }
            console.log(this.filter);



            this.submit();




        }
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
