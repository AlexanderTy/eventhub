<template>
    <DefaultLayout :currentRoute="'users'">
        <div class="flex justify-between w-full mb-8">
            <h1 class="text-3xl font-bold">Users</h1>
            <LinkBtn :type="'create'" to='admin::users.create' :btn-type="'link'"/>
        </div>

        <div class="flex flex-row w-full justify-between mb-8 text-gray-600">
            <p class="">
                We've found
                <span class="text-primary font-semibold">{{ users.length }} </span> <span> {{ users.length === 1 ? "artist" : "artists" }}</span>
            </p>
            <DisplayButtons @btnClick="setSelectedButton"/>
        </div>

        <div class="flex flex-wrap gap-3">
            <UserCard :user="user" v-for="user in users" v-show="selectedButton === 'cards'"/>
            <UserList :user="user" v-for="user in users" v-show="selectedButton === 'list'"/>
        </div>

    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import {Link} from "@inertiajs/inertia-vue3";
import {directive} from "vue3-click-away";
import LinkBtn from "../../Components/Partials/LinkBtn";
import DisplayButtons from "../../Components/Partials/DisplayButtons";
import UserCard from "../../Components/Partials/UserCard";
import UserList from "../../Components/Partials/UserList";

export default {
    // included child components
    components: {
        UserList,
        UserCard,
        DisplayButtons,
        DefaultLayout,
        Link,
        LinkBtn,
    },
    // passed from controller
    props: {
        users: Object,
    },
    // custom set
    data() {
        return {
            open: false,
            currentRoute: "",
            openModal: false,
            selectedButton: 'cards',
        };
    },
    // methods
    methods: {
        onClickAway(user) {
            this.open = false;
        },
        setSelectedButton(e){
            this.selectedButton = e;
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
}
</script>
