<template>
    <div class="grid gap-4 grid-cols-[repeat(18,_minmax(0,_1fr))] items-center col-span-1 px-12 text-sm bg-white w-full h-16 rounded-2xl shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)] cursor-pointer">
        <div class="bg-[url('/images/artist.png')] col-span-2 bg-cover w-10 h-10 rounded-full"></div>
        <h2 class="col-span-5 text-lg font-semibold">{{ user.first_name }} {{ user.last_name }}</h2>
        <p class="col-span-6 text-base">{{ user.email }}</p>
        <div class="col-span-4 text-xs h-7 w-28 bg-error-bg flex justify-center items-center rounded-full">
            <p class="text-error font-bold capitalize">{{ user.role }}</p>
        </div>
        <div class="col-span-1 relative">
            <button class="text-black self-end hover:text-primary" type="button" @click="open = !open" v-click-away="onClickAway" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 24" fill="currentColor" class="w-7 h-7">
                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <div v-show="open" class="z-10 absolute p-3 left-4 top-6 flex flex-col justify-start text-left w-36 bg-white text-black rounded-md shadow-[-7px_7px_33px_rgba(114,121,125,0.25)]">
                <div class="text-left py-2.5 flex flex-row items-center gap-2.5 hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                    </svg>
                    View
                </div>
                <Link class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary" :href="$route('users.edit', { user: user.id, })" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                    Edit
                </Link>
                <button class="text-left py-2.5 border-t flex flex-row items-center gap-2.5 hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import {Link} from "@inertiajs/inertia-vue3";
import {directive} from "vue3-click-away";

export default {
    // included child components
    components: {
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        user: Object,
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
