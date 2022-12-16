<template>

    <a
        :href="$route(to)"
        :class="
            type === 'back' || type === 'cancel'
                ? 'bg-gray-600 hover:bg-gray-800'
                : type === 'submit'
                ? 'bg-b hover:bg-b-h'
                : type === 'delete'
                ? 'bg-red-600 hover:bg-red-700 '
                : 'bg-gray-600'
        "
        class="rounded w-24 px-4 py-2 text-white capitalize text-center"
        :type="type==='submit' ? 'submit' : 'button' "
    >
        {{ text ? text : type }}
    </a>
</template>
<script>
export default {
    props: {
        type: String,
        text: String,
        to: String,
    },
};
</script>
