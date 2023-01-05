<template>
    <DefaultLayout currentRoute="users">
        <form class="flex flex-col min-w-[350px] max-h-full mx-auto max-w-6xl" @submit.prevent="submit">
            <PageTitle :title="user.first_name + ' ' + user.last_name"/>
            <ul class="flex flex-row gap-2.5 z-0">
                <Tab :activeTab="activeTab" text="General" type="general" @tabClick="this.activeTab = 'general'"/>
            </ul>
            <TabPageLayout>
                <div v-show="activeTab === 'general'"
                     class=" h-full w-full grid grid-cols-5 gap-12 flex-col px-10 py-6">
                    <div class="col-span-3 pr-10 flex flex-col gap-6">
                        <div class="flex flex-row w-full gap-5">
                            <InputGroup :error="form.errors.first_name" label="First name">
                                <Input v-model="form.first_name" :error="form.errors.first_name"
                                       placeholder="User first name..."/>
                            </InputGroup>
                            <InputGroup :error="form.errors.last_name" label="Last name">
                                <Input v-model="form.last_name" :error="form.errors.last_name"
                                       placeholder="User last name..."/>
                            </InputGroup>

                            <div class="flex flex-col w-full">
                                <label class="text-xs text-g mb-2">Role</label>
                                <Select v-model="form.role" :options="roles"/>
                            </div>
                        </div>
                        <InputGroup :error="form.errors.email" label="E-mail">
                            <Input v-model="form.email" :error="form.errors.email" />
                        </InputGroup>
                        <ImageUpload
                            @imageUploaded="setImage"
                            :image="this.form.image"
                            @imageRemoved="this.form.image = ''"
                            type="users"
                        />
                    </div>
                    <div v-if="user.image" class="col-span-2 flex justify-center items-center">

                        <div class="bg-white p-2.5 pt-5 rounded-2xl relative flex flex-col gap-3 items-center">

                            <CircleImage :user="user" size="large" />
                            <div class="flex flex-col items-center">
                                <h2 class="text-lg font-base text-center">
                                    {{ user.first_name }} {{ user.last_name }}
                                </h2>
                                <p class="text-sm text-gray-400">{{ user.email }}</p>
                            </div>
                            <div class="text-xs h-7 w-28 bg-error-secondary flex justify-center items-center rounded-full">
                                <p class="text-error-primary font-bold capitalize">{{ user.role }}</p>
                            </div>

                        </div>
                    </div>

                </div>
            </TabPageLayout>


            <div class="flex justify-end space-x-8 mt-8">
                <LinkBtn :type="'back'" to="admin::users.index"/>

                <Btn :text="'save'" :type="'submit'"/>
            </div>

        </form>
    </DefaultLayout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import Input from "../../Components/Partials/Input";
import Select from "../../Components/Partials/Select";
import {directive} from "vue3-click-away";
import Modal from "../../Components/Modal";
import Tab from "../../Components/Partials/Tab";
import LinkBtn from "../../Components/Partials/LinkBtn";
import PageTitle from "../../Components/Partials/PageTitle";
import TabPageLayout from "../../Layouts/TabPageLayout";
import InputGroup from "../../Components/Partials/InputGroup";
import ImageUpload from "../../Components/Partials/ImageUpload";
import UserCard from "../../Components/Partials/UserCard";
import CircleImage from "../../Components/Partials/CircleImage";

export default {
    // included child components
    components: {
        CircleImage,
        UserCard,
        ImageUpload,
        InputGroup,
        TabPageLayout,
        PageTitle,
        LinkBtn,
        Tab,
        Modal,
        Select,
        Input,
        Btn,
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        user: Object,
        type: String,
        roles: Object,
    },
    // custom set
    data() {
        return {
            form: this.$inertia.form({
                email: this.user.email,
                first_name: this.user.first_name,
                last_name: this.user.last_name,
                password: this.user.password,
                role: this.user.role,
                image: this.user.image,
            }),
            open: false,
            openModal: false,
            activeTab: 'general',
            activeTabContent: false,
        };
    },
    // actions on init
    mounted() {
        this.myFirstFunction();
    },
    // methods
    methods: {
        myFirstFunction() {
            console.log(this.openModal);
        },
        updateActiveTab(e) {
            this.activeTab = e;
        },
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(
                    this.$route("admin::users.update", {
                        user: this.user.id,
                    })
                );
        },
        setImage(event) {
            this.form.image = event;
            this.theImage = event.name;
        },

        deleteUser() {
            this.$inertia.delete(
                this.$route("admin::users.destroy", {
                    user: this.user.id,
                })
            );
        },
        onClickAway(event) {
            this.open = false;
        },
    },
    directives: {
        ClickAway: directive,
    },
};
</script>
