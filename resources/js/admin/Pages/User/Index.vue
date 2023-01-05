<template>
    <DefaultLayout :currentRoute="'users'">
        <div class="flex justify-between w-full mb-8">
            <div class="flex gap-8">
                <h1 class="font-bold text-3xl">Users</h1>
                <form class="flex flex-row gap-7" @submit.prevent="submit">
                    <Input
                        v-model="filter.search"
                        :class="'shrink-0 w-96 2xl:w-[484px] h-9'"
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

        <div class="flex flex-row w-full justify-between mb-4 text-gray-600">
            <p class="">
                We've found
                <span class="text-primary font-semibold">{{ users.length }} </span> <span> {{ users.length === 1 ? "artist" : "artists" }}</span>
            </p>
            <DisplayButtons />
        </div>
        <div class="flex flex-wrap gap-4">
            <UserCard :user="user" v-for="user in users" v-show="$page.props.profile.settings?.displayBtns === 'cards'"/>
        </div>
        <div v-show="$page.props.profile.settings?.displayBtns === 'list'" class="flex flex-col">
            <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div class="md:rounded-lg">
                        <table
                            class="min-w-full divide-y divide-white-secondary"
                        >
                            <thead class="bg-white bg-opacity-50">
                            <tr>
                                <th
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                    scope="col"
                                >
                                    Image
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Name
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Email
                                </th>
                                <th
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    scope="col"
                                >
                                    Role
                                </th>
                                <th
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                    scope="col"
                                >
                                    <span class="sr-only">Settings</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-white-secondary bg-white"
                            >
                            <UserList :user="user" v-for="user in users" v-show="$page.props.profile.settings?.displayBtns === 'list'"/>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
