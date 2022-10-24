<template>
    <div class="h-full fixed bg-slate-400 justify-between flex flex-col py-12 pl-4 ">
        <MenuNavList />
        <MenuUser :name="name" />
    </div>
</template>

<script>
import MenuNavList from "./Partials/MenuNavList.vue";
import MenuUser from "./Partials/MenuUser";
export default {
    components: {MenuUser, MenuNavList},
    props: {
        name: String,
    },
}
</script>

