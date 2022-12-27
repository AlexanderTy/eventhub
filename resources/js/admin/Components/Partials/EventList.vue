<template>

        <tr>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                <div class="flex items-center">
                    <div class="">
                        <Link :href="$route('admin::events.show', { event: event.id })" class="font-semibold text-lg hover:underline">{{ event.title }}</Link>
                        <h3 class="text-sm" :class="event.artists.length >= 4 ? 'text-sm' : event.artists.length >= 2 ? 'text-xs' : 'text-sm'">
                            by
                            <span v-for="(artist, index) in event.artists" v-show="event.artists.length < 4">
                            <Link :href="$route('admin::artists.show', { artist: artist.id })"
                                  class="text-primary hover:underline font-medium">
                                {{ artist.name }}
                            </Link>
                            <span v-if="index + 1 < event.artists.length">, </span>
                        </span>
                            <span v-show="event.artists.length >= 4" >
                            <span class="text-primary font-medium">{{ event.artists.length }}</span> different artists
                        </span>
                        </h3>
                    </div>
                </div>
            </td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                <DatesStatus :dates="event.dates" length="short"/>
            </td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                <p class="text-gray-900">{{ $date(event.sale_start) }}</p>
                <p class="text-gray-500">{{ $time(event.sale_start) }}</p>

            </td>
            <td class="whitespace-nowrap px-3 py-4">
                <PublishedStatus :status="event.public"/>
            </td>
            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                <div class="relative">
                    <button class="text-black rounded-md self-end hover:bg-white-secondary hover:bg-opacity-60" type="button" @click.prevent="open = !open" v-click-away="onClickAway" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div v-show="open" class="absolute z-10 p-3 right-0 top-6 flex flex-col justify-start text-left w-32 bg-white text-black rounded-md shadow-[7px_7px_25px_-2px_rgba(216,208,208,0.75)]">
                        <Link class="text-left py-2.5 flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::events.show', { event: event.id })">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                            </svg>
                            View
                        </Link>
                        <Link class="text-left py-2.5 border-t border-white-seconday flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::events.edit', { event: event.id, })" >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                            Edit
                        </Link>
                        <button class="text-left py-2.5 border-t border-white-seconday flex flex-row items-center gap-2.5 hover:text-primary"
                                type="button"
                                @click.prevent="openModal = true"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd"
                                      d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Delete
                        </button>
                        <Teleport to="#app">
                            <Modal
                                v-show="openModal"
                                :type="'event'"
                                :deleteItem="event.title"
                                @close-modal="openModal = false"
                                @action-modal="deleteEvent"
                            />
                        </Teleport>
                    </div>
                </div>
            </td>
        </tr>


<!--    <Link
        :href="$route('admin::events.show', { event: event.id })"
        class="grid gap-4 grid-cols-[repeat(17,_minmax(0,_1fr))] items-center col-span-1 px-12 text-sm bg-white w-full h-16 rounded-2xl shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)] cursor-pointer">
        <div class="col-span-4 flex flex-col">

            <Link :href="$route('admin::events.show', { event: event.id })" class="font-semibold text-base hover:underline">{{ event.title }}</Link>
            <h3 class="text-sm" :class="event.artists.length >= 4 ? 'text-sm' : event.artists.length >= 2 ? 'text-xs' : 'text-sm'">
                by
                <span v-for="(artist, index) in event.artists" v-show="event.artists.length < 4">
                            <Link :href="$route('admin::artists.show', { artist: artist.id })"
                                  class="text-primary font-bold hover:underline">
                                {{ artist.name }}
                            </Link>
                            <span v-if="index + 1 < event.artists.length">, </span>
                        </span>
                <span v-show="event.artists.length >= 4" >
                            <span class="text-primary font-bold">{{ event.artists.length }}</span> different artists
                        </span>
            </h3>
        </div>
        <DatesStatus :dates="event.dates" length="short" class="col-span-3 text-center"/>
        <div class="col-span-3">
            <p class="text-center">{{ $date(event.sale_start) }}</p>
            <p class="text-center">{{ $time(event.sale_start) }}</p>
        </div>
        <div class="col-span-3">
            <p class="text-center">{{ $date(event.sale_end) }}</p>
            <p class="text-center">{{ $time(event.sale_end) }}</p>
        </div>
        <div class="col-span-3 m-auto">
            <PublishedStatus :status="event.public"/>
        </div>
        <div class="relative col-span-1 justify-self-end">
            <button class="text-black self-end hover:text-primary" type="button" @click.prevent="open = !open" v-click-away="onClickAway" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div v-show="open" class="absolute z-10 p-3 left-4 top-6 flex flex-col justify-start text-left w-32 bg-white text-black rounded-md shadow-[-7px_7px_33px_rgba(114,121,125,0.25)]">
                <Link class="text-left py-2.5 flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::events.show', { event: event.id })">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                    </svg>
                    View
                </Link>
                <Link class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::events.edit', { event: event.id, })" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                    Edit
                </Link>
                <button class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary"
                        type="button"
                        @click.prevent="openModal = true"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                              d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                              clip-rule="evenodd"/>
                    </svg>
                    Delete
                </button>
                <Teleport to="#app">
                    <Modal
                        v-show="openModal"
                        :type="'event'"
                        :deleteItem="event.title"
                        @close-modal="openModal = false"
                        @action-modal="deleteEvent"
                    />
                </Teleport>
            </div>
        </div>
    </Link>-->


</template>

<script>
import CreateModal from "../CreateModal";
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "./PublishedStatus";
import {Link} from "@inertiajs/inertia-vue3";
import {directive} from "vue3-click-away";
import DatesStatus from "./DatesStatus";
import Modal from "../Modal";

export default {
    // included child components
    components: {
        Modal,
        DatesStatus,
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        event: Object,
        status: Boolean,
    },
    // custom set
    data() {
        return {
            open: false,
            currentRoute: "",
            openModal: false,
        };
    },

    // methods
    methods: {
        deleteEvent() {
            this.$inertia.delete(
                this.$route("admin::events.destroy", {
                    event: this.event.id,
                })
            );
        },
        onClickAway(event) {
            this.open = false;
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
}

</script>

<style scoped>

</style>
