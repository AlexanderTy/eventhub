<template>
    <DefaultLayout>
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Role</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <td class="px-4 py-2">
                    {{ user.email }}
                </td>
                <td class="px-4 py-2">
                    {{ user.name }}
                </td>
                <td class="px-4 py-2">
                    {{ user.role }}
                </td>
                <td>
                    <Link
                        class="text-sm text-amber-500 hover:text-amber-700 hover:underline"
                        :href="$route('users.edit', {
                            user: user.id
                        })"
                        >Edit</Link
                    >

                </td>
            </tr>
        </tbody>
    </DefaultLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DefaultLayout from "../../Layouts/DefaultLayout";

export default {
    // included child components
    components: {
        DefaultLayout,
        Link,
    },
    // passed from controller
    props: {
        users: Object,
    },
    // custom set
    data() {
        return {};
    },
    // actions on init

    // methods
};
</script>
