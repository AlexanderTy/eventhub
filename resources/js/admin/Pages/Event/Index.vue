<template>
    <DefaultLayout currentRoute="events">
        <div class="flex mb-8 w-full justify-between">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Events</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        bg="bg-white"
                        class="shrink-0 w-96 2xl:w-[484px] h-9"
                        placeholder="Search for events, artists"
                        type="search"
                    />
                    <div v-click-away="closeSort" class="relative">
                        <Btn
                            :open="showSortBy"
                            text="Sort by"
                            type="toggleDropdown"
                            @click="showSortBy = !showSortBy"
                            :class="filter.sortOption !==  '' ? 'border border-primary' : ''"

                        />
                        <CustomSelect
                            v-show="showSortBy"
                            :active="filter.sortOption"
                            :class="showSortBy ? 'rounded-b-md' : 'rounded-md'"
                            :options="sortOptions"
                            :sortDirection="filter.order"
                            @selectOption="sortEvents"
                        />
                    </div>

                    <div v-click-away="closeFilter" class="relative">
                        <Btn
                            :count="filter.filterArray.length"
                            :open="showFilter"
                            text="Filter"
                            type="toggleDropdown"
                            @click="showFilter = !showFilter"
                            :class="filter.filterArray.length > 0 ? 'border border-primary' : ''"
                        />
                        <select
                            v-show="showFilter"
                            :class="showFilter ? 'rounded-b-md' : 'rounded-md'"
                            class="absolute z-20 w-full h-[165px] px-2 py-1 cursor-pointer bg-white shadow-[5px_20px_17px_-2px_rgba(0,0,0,0.15)]"
                            multiple
                            @change="updateFilter"
                        >
                            <option
                                v-for="(value, key) in filterOptions"
                                :key="key"
                                :class="
                                    filter.filterArray.includes(key)
                                        ? 'text-primary font-semibold'
                                        : ''
                                "
                                :value="key"
                                class="flex gap-1.5 items-center my-6"
                            >
                                {{ value }}
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <Btn type="create" @click="openModal = !openModal" />
            <Teleport to="#app">
                <CreateModal
                    v-if="openModal"
                    label="Create new event"
                    type="event"
                    @close-modal="openModal = false"
                    placeholder="Venue name"
                />
            </Teleport>
        </div>
        <div class="flex flex-row w-full justify-between mb-4 text-gray-600">
            <p>
                We've found
                <span class="text-primary font-semibold">{{
                    events.length
                }}</span>
                <span>{{ events.length === 1 ? " event" : " events" }}</span>
            </p>

            <DisplayButtons @btnClick="(n) => (selectedButton = n)" />
        </div>
        <div class="flex flex-wrap gap-4">
            <EventCard
                v-for="event in events"
                v-show="selectedButton === 'cards'"
                :event="event"
            />
        </div>
        <div v-show="selectedButton === 'list'" class="flex flex-col">
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
                                        Title
                                    </th>
                                    <th
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        scope="col"
                                    >
                                        Upcoming dates
                                    </th>
                                    <th
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        scope="col"
                                    >
                                        Sale start
                                    </th>
                                    <th
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        scope="col"
                                    >
                                        Public
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
                                <EventList
                                    v-for="event in events"
                                    v-show="selectedButton === 'list'"
                                    :event="event"
                                />
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
            selectedButton:
                this.$page.props.profile.settings?.displayBtns ?? "cards",
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
            previousSort: "",
        };
    },
    methods: {
        onClickAway() {
            this.open = "";
        },
        closeSort() {
            this.showSortBy = false;
        },
        closeFilter() {
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
                if (this.filter.order === "desc") {
                    // set sort direction to ascending
                    this.filter.order = "asc";
                } else {
                    // toggle sort direction
                    this.filter.order =
                        this.filter.order === "asc" ? "desc" : "asc";
                }
            } else {
                // set sort direction to ascending (default)
                this.filter.order = "asc";
            }
            this.submit();
        },
        updateFilter(e) {
            // check if the selected option is already in the filterArray
            if (this.filter.filterArray.includes(e.target.value)) {
                // remove the option from the filterArray
                this.filter.filterArray = this.filter.filterArray.filter(
                    (item) => item !== e.target.value
                );
            } else {
                // add the option to the filterArray
                this.filter.filterArray.push(e.target.value);
            }
            this.submit();
        },
        resetSort() {
            this.filter.sortOption = "";
            this.filter.order = "";
            this.submit();
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
};
</script>
