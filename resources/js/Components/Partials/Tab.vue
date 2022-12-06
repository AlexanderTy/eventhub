<template>
    <li class="z-0 flex justify-center items-center pb-2.5 h-11 w-36 rounded-md cursor-pointer text-sm"
         :class="activeTab === type|| secondaryActiveTab=== type ? 'bg-white font-bold' : 'bg-tab-secondary font-base'"
         @click="$emit('tabClick')"
    >
       {{text}}
    </li>

</template>

<script>
export default {

    props: {
        text: String,
        type: String,
        active: Boolean,
        activeTab: String,
        secondaryActiveTab:String,
    },
}
</script>

<style scoped>

</style>
