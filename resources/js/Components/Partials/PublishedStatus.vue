<template>
    <div  v-show="status" class="text-xs h-7 w-28 bg-success-bg flex justify-center items-center rounded-full">
        <p class="text-success font-bold">Published</p>
    </div>
    <div v-show="!status" class="text-xs h-7 w-28 bg-error-bg flex justify-center items-center rounded-full">
        <p class="text-error font-bold">Not published</p>
    </div>
</template>


<script>
export default {
    props: {
        status: Boolean
    },
};
</script>
