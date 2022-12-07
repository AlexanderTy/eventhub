<template>

    <button
        :class="
            type === 'back' || type === 'cancel'
                ? 'bg-gray-600 hover:bg-gray-800'
                : type === 'submit'
                ? 'bg-primary hover:brightness-75'
                : type === 'delete'
                ? 'bg-red-600 hover:bg-red-700 '
                : type === 'create'
                ? 'bg-primary hover:bg-red-700'
                : 'bg-lb'
        "
        class="rounded-md px-4 py-2 text-white capitalize text-base flex flex-row items-center justify-center gap-2 rounded-full py-2 px-6 font-semibold"
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
