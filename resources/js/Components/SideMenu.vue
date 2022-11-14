<template>
    <div
        :class="closeSidemenu ? 'w-16' : 'w-52'"
        class="z-20 text-white h-full fixed bg-secondary shadow-[7px_13px_13px_rgba(0,0,0,0.25)] justify-between flex flex-col pb-12 pt-6"
    >
        <div class="w-14 h-auto absolute top-12 right-0 -mr-7">
            <ToggleSidemenuBtn
                :close="closeSidemenu"
                @click="closeSidemenu = !closeSidemenu"
            />
        </div>
        <nav class="flex flex-col space-y-16">
            <div :class="closeSidemenu ? 'px-2' : ''" class="mx-auto">
                <img
                    alt="logo"
                    height="100"
                    src="/images/logo.svg"
                    width="98"
                />
            </div>

            <ul
                :class="closeSidemenu ? 'flex justify-center flex-col' : ''"
                class="text-base space-y-2 text-white"
            >
                <li class="flex gap-5 hover:text-primary cursor-pointer">
                    <a class="pl-4 w-full flex border-l-4 py-2  border-transparent" :class="currentRoute === 'dashboard' ? 'bg-white bg-opacity-10 border-primary text-primary' : ''" href="/">
                        <div class="w-8 h-6">
                            <svg
                                class="w-full h-full"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    clip-rule="evenodd"
                                    d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 011.5 10.875v-3.75zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 01-1.875-1.875v-8.25zM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 013 18.375v-2.25z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <p v-show="!closeSidemenu" class="ml-4">Dashboard</p>
                    </a>
                </li>
                <li class="flex gap-5 hover:text-primary cursor-pointer">
                    <Link class="pl-4 w-full flex border-l-4 py-2 border-transparent" :class="currentRoute === 'events' ? 'bg-white bg-opacity-10 border-primary text-primary' : ''" :href="$route('events.index')">
                        <div class="w-8 h-6">
                            <svg
                                class="w-full h-full"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    clip-rule="evenodd"
                                    d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <p v-show="!closeSidemenu" class="ml-4">Events</p>
                    </Link>
                </li>
                <li class="flex gap-5 hover:text-primary cursor-pointer">
                    <a class="pl-4 w-full flex border-l-4 py-2 border-transparent" :class="currentRoute === 'artists' ? 'bg-white bg-opacity-10 border-primary text-primary' : ''" href="">
                        <div class="w-8 h-6">
                            <svg
                                class="w-full h-full"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M12.32,2.79c-.77-.77-1.82-1.21-2.91-1.21s-2.15,.44-2.92,1.21c-.77,.77-1.21,1.82-1.21,2.92s.44,2.14,1.21,2.91c.77,.78,1.82,1.21,2.92,1.21s2.14-.43,2.91-1.21c.78-.77,1.21-1.82,1.21-2.91s-.43-2.15-1.21-2.92Zm-2.91,8.54c-1.89,0-3.71,.75-5.04,2.09-1.34,1.33-2.09,3.15-2.09,5.04v.12c0,.13,.04,.25,.1,.36,.07,.11,.16,.2,.27,.27,1.97,1.19,4.28,1.87,6.76,1.87,.57,0,1.15-.04,1.71-.11,.04-.22,.11-.44,.19-.65,.72-1.78,1.45-3.55,2.18-5.32l.74-1.77c-1.3-1.22-3.03-1.9-4.82-1.9Z"
                                />
                                <path
                                    d="M21.58,10.65c-.42-1.32-1.63-2.17-2.92-2.17-.3,0-.6,.04-.9,.14-1.59,.5-2.47,2.23-1.95,3.86,.41,1.32,1.62,2.17,2.92,2.17,.29,0,.6-.04,.89-.14,1.6-.5,2.47-2.23,1.96-3.86Z"
                                />
                                <path
                                    d="M18.99,15.2c-.45,.7-.85,1.36-1.27,2.02-.98,1.53-1.96,3.03-2.92,4.58-.12,.21-.26,.36-.42,.46-.08,.06-.17,.09-.26,.12-.09,.03-.17,.04-.27,.04-.07,0-.13,0-.21,0-.07,0-.48-.18-.87-.4-.34-.21-.16-.92-.07-1.13,.03-.08,.06-.16,.1-.24,.83-2.05,1.68-4.1,2.53-6.14,.12-.29,.24-.59,.36-.88,.01-.02,.02-.03,.06-.09,.77,1.16,1.85,1.66,3.24,1.67Z"
                                />
                            </svg>
                        </div>
                        <p v-show="!closeSidemenu" class="ml-4">Artists</p>
                    </a>
                </li>
                <li class="flex gap-5 hover:text-primary cursor-pointer">
                    <Link class="pl-4 w-full flex border-l-4 py-2 border-transparent" :class="currentRoute === 'users' ? 'bg-white bg-opacity-10 border-primary text-primary' : ''" :href="$route('users.index')">
                        <div class="w-8 h-6">
                            <svg
                                class="w-full h-full"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"
                                />
                            </svg>
                        </div>
                        <p v-show="!closeSidemenu" class="ml-4">Users</p>
                    </Link>
                </li>
            </ul>
        </nav>
        <Logout />
    </div>
</template>

<script>
import Logout from "./Partials/Logout";
import ToggleSidemenuBtn from "./Partials/ToggleSidemenuBtn";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: { ToggleSidemenuBtn, Logout, Link },
    props: {
        currentRoute: String,
    },
    // custom set
    data() {
        return {
            closeSidemenu:false,
        };
    },
};
</script>
