<template>
    <div v-show="message" class="absolute bottom-0 -mb-5">
        <p class="text-xs text-red-600">
            {{ message }}
        </p>
    </div>
</template>

<script>
export default {
    props: ["message"],
};
</script>
