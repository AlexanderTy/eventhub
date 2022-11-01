<template>
    <button
        :class="
            type === 'back'
                ? 'bg-lg hover:bg-lg-h'
                : type === 'submit'
                ? 'bg-b hover:bg-b-h'
                : 'bg-lb'
        "
        class="rounded w-24 px-4 py-2 text-white capitalize"
    >
        {{ text ? text : type }}
    </button>
</template>
<script>
export default {
    props: {
        type: String,
        text: String,
    },
};
</script>
