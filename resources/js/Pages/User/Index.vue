<template>
    <DefaultLayout :currentRoute="'users'">
        <div class="flex justify-between w-full mb-12">
            <h1 class="text-3xl font-bold">Users</h1>
            <LinkBtn :type="'create'" :to="'users.create'" :btn-type="'link'"/>
        </div>
        <section class="h-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">First name</th>
                    <th class="px-4 py-2 text-left">Last name</th>
                    <th class="px-4 py-2 text-left">Role</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td class="px-4 py-2">
                        {{ user.email }}
                    </td>
                    <td class="px-4 py-2">
                        {{ user.first_name }}
                    </td>
                    <td class="px-4 py-2">
                        {{ user.last_name }}
                    </td>
                    <td class="px-4 py-2">
                        {{ user.role }}
                    </td>
                    <td>
                        <Link
                            :href="
                                $route('users.edit', {
                                    user: user.id,
                                })
                            "
                            class="text-sm text-amber-500 hover:text-amber-700 hover:underline"
                            >Edit
                        </Link>

                    </td>
                </tr>
            </tbody>
        </section>
    </DefaultLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";
import Btn from "../../Components/Partials/Btn";
import LinkBtn from "../../Components/Partials/LinkBtn";

export default {
    // included child components
    components: {
        LinkBtn,
        Btn,
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        users: Object,

    },
    // custom set
    data() {
        return {
            currentRoute: '',
        };
    },
    // actions on init

    // methods
};
</script>
