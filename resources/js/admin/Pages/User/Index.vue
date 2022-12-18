<template>
    <DefaultLayout :currentRoute="'users'">
        <div class="flex justify-between w-full mb-8">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Users</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 shadow w-96 2xl:w-[484px] h-9 shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]'"
                        bg="bg-white"
                        placeholder="Search for events, artists"
                        type="search"
                    />

                    <div class="relative" v-click-away="closeSort">
                        <Btn type="toggleDropdown"
                             text="Sort by"
                             @click="showSortBy = !showSortBy"
                             :open="showSortBy"/>
                        <CustomSelect
                            v-show="showSortBy"
                            :active="filter.sortOption"
                            :options="sortOptions"
                            :sortDirection="filter.order"
                            @selectOption="sortUsers"
                            :class="showSortBy ? 'rounded-b-md' : 'rounded-md'"
                        />
                    </div>
                </form>
            </div>
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
import Input from "../../Components/Partials/Input";
import Btn from "../../Components/Partials/Btn";
import CustomSelect from "../../Components/Partials/CustomSelect";

export default {
    // included child components
    components: {
        CustomSelect,
        Btn,
        Input,
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
        request: Object,
    },
    // custom set
    data() {
        return {
            filter: this.$inertia.form({
                search: this.request.search,
                sortOption: this.request.sortOption ?? "",
                order: this.request.order,
            }),
            open: false,
            currentRoute: "",
            openModal: false,
            selectedButton: 'cards',
            showSortBy: false,
            sortOptions: {
                "first_name": "First Name",
                "last_name": "Last Name",
                "email": "Email",
                "created_at": "Created at",
                "role": "Role",
            }
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
        closeSort(){
            this.showSortBy = false;
        },
        sortUsers(e){
            this.filter.sortOption = e;
            this.filter.order = this.filter.order === 'asc' ? 'desc' : 'asc';
            this.submit();
        },

        submit() {
            this.filter.get(this.$route('admin::users.index'));
        },
    },
    // directives
    directives: {
        ClickAway: directive,
    },
}
</script>
