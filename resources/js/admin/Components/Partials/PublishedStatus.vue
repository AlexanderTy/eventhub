<template>
    <div  v-show="status" class="text-xs h-7 w-28 bg-success-secondary flex justify-center items-center rounded-full">
        <p class="text-success-primary font-bold">Published</p>
    </div>
    <div v-show="!status" class="text-xs h-7 w-28 bg-error-secondary flex justify-center items-center rounded-full">
        <p class="text-error-primary font-bold">Not published</p>
    </div>
</template>


<script>
export default {
    props: {
        status: Boolean
    },
};
</script>
