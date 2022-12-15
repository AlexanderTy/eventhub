<template>
    <div
        :class="closeSidemenu ? 'w-16' : 'w-52'"
        class="transition-all duration-500 z-30 text-white h-full fixed bg-secondary shadow-[7px_13px_13px_rgba(0,0,0,0.25)] justify-between flex flex-col pb-12 pt-6"
    >
        <div class="w-14 h-auto absolute top-12 right-0 -mr-7">
            <ToggleSidemenuBtn :close="closeSidemenu" @click="setSidemenu"/>
        </div>
        <nav class="flex flex-col space-y-16">
            <div :class="closeSidemenu ? 'hidden' : ''" class="mx-auto">
                <svg
                    class="hover:text-primary text-white h-auto w-[98px]"
                    fill="currentColor"
                    viewBox="0 0 630.2 334.1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M114.3 203.3V220c0 2.9-2.3 5.2-5.2 5.2H32.4c-2.9 0-5.2-2.3-5.2-5.2v-16.7c0-2.9 2.3-5.2 5.2-5.2h19.4c2.9 0 5.2-2.3 5.2-5.2V99.4c0-3.5-3.3-6-6.7-5l-14.8 4.3c-3.3 1-6.7-1.5-6.7-5V76.9c0-2.3 1.4-4.2 3.6-5l46.8-15.5c3.4-1.1 6.9 1.4 6.9 5v131.5c0 2.9 2.3 5.2 5.2 5.2H109c3 0 5.3 2.3 5.3 5.2zm154.5-1.4h-18c-2.8 0-5 2.1-5.2 4.9l-.8 13.5c-.2 2.8-2.5 4.9-5.2 4.9h-64c-2.9 0-5.2-2.3-5.2-5.2v-7.5c0-18.5 19.3-25.8 39.2-27.2 39.5-2.6 64.3-12 64.3-51.3 0-37.8-31-52.5-62.3-52.5-34.2 0-61.1 10.1-66.2 44.8-.5 3.2 2 6 5.2 6h19.1c2.6 0 4.7-1.9 5.1-4.4 3.1-17.9 22.8-20.1 36.9-20.1 19.7 0 33.2 8.4 33.2 26.7 0 19.3-22.9 23.8-35.4 24.5-34.2 2.2-68.8 14.9-68.8 53.4v34.7c0 2.9 2.3 5.2 5.2 5.2H269c2.9 0 5.2-2.3 5.2-5.2V207c-.2-2.7-2.5-5.1-5.4-5.1zM438 172.3c0 37.3-35.6 55.4-69.3 55.4-39.5 0-70.3-18.1-70.3-56.1v-63.3c0-37.1 34.4-53.9 68.8-53.9 36.1 0 64.1 12.2 67.1 42.9.3 3.1-2.1 5.7-5.2 5.7h-19.3c-2.5 0-4.7-1.8-5.1-4.2-2.5-13.6-18.5-19.4-37-19.4-20.7 0-40.4 9.6-40.4 29.6v13.5c0 4.2 4.7 6.6 8.2 4.3 10.3-6.8 22.2-9.1 33.5-9.1 33.6 0 69 13.5 69 54.6zm-29.4 0c0-20.2-17.8-28.6-39.5-28.6-21.4 0-41.4 9.1-41.2 28.9.2 19.5 19.7 28.4 40.7 28.4 20.5-.5 40-9.2 40-28.7zM603 100.8V127c0 49.3-31.5 73.4-72 73.4-41.4 0-71.7-24.3-71.7-73.4v-26.2c0-49.1 35.6-73.6 72.4-73.6 39.6 0 71.3 24.3 71.3 73.6zm-29.6-.4c0-30.6-15.6-45.5-41.6-45.5-24.1 0-42.8 15.2-42.8 46v26.2c0 30.6 17.8 45.7 41.9 45.7 23.8 0 42.6-14.9 42.6-46.2v-26.2zM433 279.7H303.3c-2.7 0-4.9 2.2-4.9 4.9V302c0 2.7 2.2 4.9 4.9 4.9H433c2.7 0 4.9-2.2 4.9-4.9v-17.4c0-2.7-2.2-4.9-4.9-4.9z"
                    />
                </svg>
            </div>

            <ul
                :class="closeSidemenu ? 'flex justify-center flex-col' : ''"
                class="text-base space-y-2 text-white"
            >
                <SidemenuItem
                    :active="currentRoute === 'dashboard' || !currentRoute"
                    :closeSidemenu="closeSidemenu"
                    route="dashboard"
                    text="Dashboard"
                >
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
                </SidemenuItem>
                <SidemenuItem
                    :active="currentRoute === 'events'"
                    :closeSidemenu="closeSidemenu"
                    route="events.index"
                    text="Events"
                >
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
                </SidemenuItem>
                <SidemenuItem
                    :active="currentRoute === 'artists'"
                    :closeSidemenu="closeSidemenu"
                    route="artists.index"
                    text="Artists"
                >
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
                </SidemenuItem>
                <SidemenuItem
                    :active="currentRoute === 'venues'"
                    :closeSidemenu="closeSidemenu"
                    route="venues.index"
                    text="Venues"
                >
                    <svg
                        class="w-full h-full"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            clip-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                            fill-rule="evenodd"
                        />
                    </svg>
                </SidemenuItem>
                <SidemenuItem
                    :active="currentRoute === 'users'"
                    :closeSidemenu="closeSidemenu"
                    route="users.index"
                    text="Users"
                >
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
                </SidemenuItem>
            </ul>
        </nav>
    </div>
</template>

<script>
import Logout from "./Partials/Logout";
import ToggleSidemenuBtn from "./Partials/ToggleSidemenuBtn";
import {Link} from "@inertiajs/inertia-vue3";
import SidemenuItem from "./Partials/SidemenuItem";
export default {
    components: {SidemenuItem, ToggleSidemenuBtn, Logout, Link},
    props: {
        currentRoute: String,
    },
    // custom set
    data() {
        return {
            active: false,
            closeSidemenu: this.$page.props.profile.settings?.closeSidemenu ?? false,
            form: this.$inertia.form({
                ...this.$page.props.profile.settings,
                closeSidemenu: false,
            }),
        };
    },
    //mounted function
    mounted() {
        this.form.closeSidemenu = this.closeSidemenu;
        console.log(this.$page.props.profile.settings)
    },
    methods: {
        setSidemenu() {

            this.closeSidemenu = !this.closeSidemenu;
            this.form.closeSidemenu = this.closeSidemenu;
            this.$emit('clickSidemenu', this.closeSidemenu);
            //post form to route user.settings
            this.$inertia.post(this.$route('user.saveSettings'), this.form)
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route('user.saveSettings')
                );
        },
    },
};
</script>
