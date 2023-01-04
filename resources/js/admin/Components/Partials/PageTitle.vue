<template>
    <div class="flex justify-between">
        <div class="flex items-center mb-5">
            <h2 class="font-bold text-2xl capitalize">
                {{ title }}
            </h2>
        </div>

       <slot />

    </div>
</template>
<script>
export default {
    props: {
        title: String,

    },
};
</script>
