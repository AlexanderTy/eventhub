<template>

    <Link
        :href="0 ? $route(to) : ''"
        :class="
            type === 'back' || type === 'cancel'
                ? 'bg-gray-600 hover:bg-gray-800'
                : type === 'submit'
                ? 'bg-primary hover:bg-red-700'
                : type === 'delete'
                ? 'bg-red-600 hover:bg-red-700 '
                : type === 'create' || type === 'edit'
                ? 'bg-primary hover:bg-red-700 flex flex-row items-center justify-center gap-2'
                : 'bg-gray-600'
        "
        class="rounded-full min-w-[7.5rem] px-6 py-2 text-white capitalize text-center font-semibold"
        :type="type==='submit' ? 'submit' : 'button' "
    >
        <svg v-show="type === 'create'" class="shrink-0" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.2 1.2C7.2 0.88174 7.07357 0.576516 6.84853 0.351472C6.62348 0.126428 6.31826 0 6 0C5.68174 0 5.37652 0.126428 5.15147 0.351472C4.92643 0.576516 4.8 0.88174 4.8 1.2V4.8H1.2C0.88174 4.8 0.576516 4.92643 0.351472 5.15147C0.126428 5.37652 0 5.68174 0 6C0 6.31826 0.126428 6.62348 0.351472 6.84853C0.576516 7.07357 0.88174 7.2 1.2 7.2H4.8V10.8C4.8 11.1183 4.92643 11.4235 5.15147 11.6485C5.37652 11.8736 5.68174 12 6 12C6.31826 12 6.62348 11.8736 6.84853 11.6485C7.07357 11.4235 7.2 11.1183 7.2 10.8V7.2H10.8C11.1183 7.2 11.4235 7.07357 11.6485 6.84853C11.8736 6.62348 12 6.31826 12 6C12 5.68174 11.8736 5.37652 11.6485 5.15147C11.4235 4.92643 11.1183 4.8 10.8 4.8H7.2V1.2Z" fill="white"/>
        </svg>
        <svg v-show="type === 'edit'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
        </svg>

        {{ text ? text : type }}
    </Link>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        type: String,
        text: String,
        to: String,
    },
    mounted() {
    }
};
</script>
