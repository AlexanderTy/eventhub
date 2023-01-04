<template>
    <div class="flex bg-white-secondary min-h-screen" id="content">

        <SideMenu :currentRoute="currentRoute" @clickSidemenu="(n) => this.closeSidemenu = n " />
        <TopMenu />
        <main class="transition-all duration-500  pt-24 pb-4 pr-16  w-full"
              :class="[
                  $page.props.profile.settings?.closeSidemenu ? 'pl-32' : 'pl-[17rem]',
                     type === 'tabpage' ? 'max-h-screen' : 'min-h-screen'
                ]">
            <slot />
            <div aria-live="assertive" class="fixed inset-0 flex items-end p-4 z-30 pointer-events-none sm:items-start">
                <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
                    <Notification v-if="$page.props.flash.success" @closed="$page.props.flash.success = null">
                        {{ $page.props.flash.success }}
                    </Notification>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
import SideMenu from "../Components/SideMenu";
import TopMenu from "../Components/TopMenu";
import Notification from "../Components/Partials/Notification";
export default {
    components: {Notification, TopMenu, SideMenu },
    props: {
        currentRoute:{
            type: String,
            default: null,
        },
        type: String,

    },
    data() {
        return {
            closeSidemenu: false,
        };
    },
    methods: {
        clickedSidemenu(event){
            this.closeSidemenu = event;
        }
    },
};
</script>
