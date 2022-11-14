<template>

    <button
        :class="
            type === 'back' || type === 'cancel'
                ? 'bg-gray-600 hover:bg-gray-800'
                : type === 'submit'
                ? 'bg-primary hover:brightness-75'
                : type === 'delete'
                ? 'bg-red-600 hover:bg-red-700 '
                : 'bg-lb'
        "
        class="rounded w-24 px-4 py-2 text-white capitalize"
        :type="type==='submit' ? 'submit' : 'button' "
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
