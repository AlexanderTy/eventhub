<template>
    <Link
        :href="$route('admin::artists.show', { artist: artist.id, })"
        class="grid gap-4 grid-cols-[repeat(18,_minmax(0,_1fr))] items-center col-span-1 px-12 text-sm bg-white w-full h-16 rounded-2xl shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)] cursor-pointer">
        <div class="col-span-2 text-tab-secondary w-10 h-10 rounded-full shrink-0 overflow-hidden">
            <img v-if="artist.image" alt="" class="w-full h-full object-cover object-top" :src="'/images/artists/' + artist.image"/>
            <svg v-else class="w-full h-full" viewBox="0 0 167 167" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M140.751 144.279C149.05 136.482 155.661 127.065 160.176 116.611C164.69 106.156 167.013 94.8873 167 83.5C167 37.3823 129.618 0 83.5 0C37.3823 0 5.57455e-05 37.3823 5.57455e-05 83.5C-0.0131202 94.8873 2.30951 106.156 6.82436 116.611C11.3392 127.065 17.9503 136.482 26.249 144.279C41.7238 158.897 62.2126 167.029 83.5 167C104.787 167.029 125.276 158.897 140.751 144.279ZM55.6807 115.512C46.9999 119.681 39.3699 125.752 33.3572 133.275C39.9171 139.901 47.7273 145.158 56.3349 148.742C64.9425 152.326 74.176 154.166 83.5 154.154C92.824 154.166 102.058 152.326 110.665 148.742C119.273 145.158 127.083 139.901 133.643 133.275C127.63 125.752 120 119.681 111.319 115.512C102.639 111.343 93.1301 109.183 83.5 109.192C73.87 109.183 64.3615 111.343 55.6807 115.512ZM106.209 80.5167C112.232 74.4939 115.615 66.3252 115.615 57.8077C115.615 49.2901 112.232 41.1215 106.209 35.0987C100.186 29.0759 92.0175 25.6923 83.5 25.6923C74.9825 25.6923 66.8138 29.0759 60.791 35.0987C54.7682 41.1215 51.3846 49.2901 51.3846 57.8077C51.3846 66.3252 54.7682 74.4939 60.791 80.5167C66.8138 86.5395 74.9825 89.923 83.5 89.923C92.0175 89.923 100.186 86.5395 106.209 80.5167Z"/>
            </svg>
        </div>

        <Link :href="$route('admin::artists.show', { artist: artist.id, })" class="col-span-5 text-lg font-semibold hover:underline">{{ artist.name }}</Link>
        <p class="col-span-7">{{ artist.description_short }}</p>
        <p class="col-span-3 self-center text-center">32</p>
        <div class="col-span-1 relative">
            <button class="text-black self-end hover:text-primary" type="button" @click.prevent="open = !open" v-click-away="onClickAway" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div v-show="open" class="z-10 absolute p-3 left-4 top-6 flex flex-col justify-start text-left w-36 bg-white text-black rounded-md shadow-[-7px_7px_33px_rgba(114,121,125,0.25)]">
                <Link class="text-left py-2.5 flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::artists.show', { artist: artist.id })">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                    </svg>
                    View
                </Link>
                <Link class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('admin::artists.edit', { artist: artist.id, })" >
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
                        :type="'artist'"
                        :deleteItem="artist.name"
                        @close-modal="openModal = false"
                        @action-modal="deleteArtist"
                    />
                </Teleport>
            </div>
        </div>
    </Link>
</template>

<script>
import CreateModal from "../CreateModal";
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "./PublishedStatus";
import {Link} from "@inertiajs/inertia-vue3";
import {directive} from "vue3-click-away";
import Modal from "../Modal";

export default {
    // included child components
    components: {
        CreateModal,
        Modal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        artist: Object,
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
        deleteArtist() {
            this.$inertia.delete(
                this.$route("admin::artists.destroy", {
                    artist: this.artist.id,
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
