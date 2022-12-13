<template>
    <li class="flex gap-5 hover:text-primary cursor-pointer">
        <a
            class="pl-4 w-full flex border-l-4 py-2 border-transparent"


            :class="
                active
                    ? 'bg-white bg-opacity-10 border-primary text-primary'
                    : ''
            "
            :href="$route(route)"
        >
            <div class="w-8 h-6">
                <slot />
            </div>
            <p v-show="!closeSidemenu" class="ml-4">
                {{
                    text
                        ? text
                        : route.split(".")[0].charAt(0).toUpperCase() +
                          route.split(".")[0].slice(1)
                }}
            </p>
        </a>
    </li>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: { Link },
    props: {
        active: Boolean,
        text: String,
        route: String,
        closeSidemenu: Boolean,
    },
    // custom set
    data() {
        return {};
    },
};
</script>
