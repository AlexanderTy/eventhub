<template>
    <div class="absolute top-full bg-white-secondary w-full px-4 max-h-72 overflow-y-auto z-50">
        <div class="border-t border-white mb-2 "></div>

        <ul class="pb-2">
            <li class="my-2" v-for="(option, index) in options"><button type="button" >{{option.name}}</button></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        options: Object,


    },

};
</script>
