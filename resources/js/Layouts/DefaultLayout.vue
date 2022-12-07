<template>
    <div class="flex" id="content">

        <SideMenu :currentRoute="currentRoute" />
        <TopMenu />
        <main class="bg-white-secondary  pt-24 pb-12  pl-72 pr-20  min-h-screen h-full w-full">
            <slot />
            <div aria-live="assertive" class="fixed inset-0 flex items-end p-4 z-30 pointer-events-none sm:items-start">
                <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
                    <Notification
                        v-if="$page.props.flash.success"
                        @closed="$page.props.flash.success = null"
                    >2
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
        }
    },
    data() {
        return {};
    },
};
</script>
