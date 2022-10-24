<template>
    <div class="flex ">
        <Menu :name="name" class='w-80 text-white'/>
        <main class="pl-4 ml-80">
            {{name}}
            <slot />
        </main>
    </div>
</template>
<script>
import Menu from "../Components/Menu";
export default {
    components: {Menu},
    props: {

        name: String,
    },
    data() {
        return {
        };
    },
}
</script>
