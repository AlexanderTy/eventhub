<template>
    <div class="self-">
        <div @click="open = !open" v-click-away="onClickAway"
             class="relative flex items-center cursor-pointer text-gray-900">
            <CircleImage :user="this.$page.props.profile" size="small" class="mr-4"/>

            <div class="capitalize mr-5">

                <p class="text-sm font-semibold">
                    {{ $page.props.profile.first_name }} {{ $page.props.profile.last_name }}
                </p>
                <p class="text-xs">
                    {{ $page.props.profile.role }}
                </p>
            </div>
            <div class="text-black mr-14">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div v-show="open" class="w-48 p-3 rounded-xl bg-white absolute left-2.5 top-10 shadow-[7px_7px_33px_-10px_rgba(0,0,0,0.25)]">
                <div class="flex items-center gap-2 py-2.5 hover:text-primary text-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                    <p>Profile</p>
                </div>
                <div class="flex items-center gap-2 py-2.5 hover:text-primary text-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 01-.517.608 7.45 7.45 0 00-.478.198.798.798 0 01-.796-.064l-.453-.324a1.875 1.875 0 00-2.416.2l-.243.243a1.875 1.875 0 00-.2 2.416l.324.453a.798.798 0 01.064.796 7.448 7.448 0 00-.198.478.798.798 0 01-.608.517l-.55.092a1.875 1.875 0 00-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 01-.064.796l-.324.453a1.875 1.875 0 00.2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 01.796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 01.517-.608 7.52 7.52 0 00.478-.198.798.798 0 01.796.064l.453.324a1.875 1.875 0 002.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 01-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 001.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 01-.608-.517 7.507 7.507 0 00-.198-.478.798.798 0 01.064-.796l.324-.453a1.875 1.875 0 00-.2-2.416l-.243-.243a1.875 1.875 0 00-2.416-.2l-.453.324a.798.798 0 01-.796.064 7.462 7.462 0 00-.478-.198.798.798 0 01-.517-.608l-.091-.55a1.875 1.875 0 00-1.85-1.566h-.344zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
                    </svg>
                    <p>Settings</p>
                </div>

                <Link :href="$route('admin::logout')" method="POST" as="button" class="flex items-center gap-2 py-2.5 hover:text-primary text-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 2.30078C5.84315 2.30078 4.5 3.64392 4.5 5.30078V18.7008C4.5 20.3576 5.84315 21.7008 7.5 21.7008H13.5C15.1569 21.7008 16.5 20.3576 16.5 18.7008V12.7493H21.7498C21.9487 12.7493 22.1395 12.6703 22.2802 12.5297C22.4208 12.389 22.4998 12.1983 22.4998 11.9993C22.4998 11.8004 22.4208 11.6097 22.2802 11.469C22.1395 11.3284 21.9487 11.2493 21.7498 11.2493H16.5V5.30078C16.5 3.64393 15.1569 2.30078 13.5 2.30078H7.5ZM16.5 11.2493H10.8098L12.5298 9.52934C12.6703 9.38871 12.7492 9.19809 12.7492 8.99934C12.7492 8.80059 12.6703 8.60997 12.5298 8.46934C12.3892 8.32889 12.1986 8.25 11.9998 8.25C11.8011 8.25 11.6105 8.32889 11.4698 8.46934L8.46983 11.4693C8.32938 11.61 8.25049 11.8006 8.25049 11.9993C8.25049 12.1981 8.32938 12.3887 8.46983 12.5293L11.4698 15.5293C11.5385 15.603 11.6213 15.6621 11.7133 15.7031C11.8053 15.7441 11.9046 15.7662 12.0053 15.7679C12.106 15.7697 12.206 15.7512 12.2994 15.7135C12.3928 15.6757 12.4776 15.6196 12.5489 15.5484C12.6201 15.4772 12.6762 15.3923 12.714 15.2989C12.7517 15.2055 12.7702 15.1055 12.7684 15.0048C12.7666 14.9041 12.7446 14.8048 12.7036 14.7128C12.6626 14.6208 12.6035 14.538 12.5298 14.4693L10.8098 12.7493H16.5V11.2493Z"/>
                        <path d="M16.5 11.25H21.75C22.1642 11.25 22.5 11.5858 22.5 12V12C22.5 12.4142 22.1642 12.75 21.75 12.75H16.5V11.25Z" fill-rule="evenodd"/>
                    </svg>
                    <p>Logout</p>
                </Link>

            </div>
        </div>

    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import {directive} from "vue3-click-away";
import CircleImage from "./CircleImage";

export default {
    components: {
        CircleImage,
        Link,
    },
    data() {
        return {
            open: false,
        };
    },
    props: {},
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
};
</script>
