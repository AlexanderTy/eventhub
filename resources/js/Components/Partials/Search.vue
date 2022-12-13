<template>
    <div class="flex items-center px-2 py-2 text-gray-600 placeholder:text-placeholder bg-white-secondary w-full" :class="open ? 'rounded-t-md' : 'rounded-md' ">
            <svg
                class="w-5 h-5 shrink-0"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        <input
            :value="modelValue"
            class="bg-transparent mx-2 focus:outline-none w-full"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <button type="button" v-show="modelValue" @click="modelValue = ''; $emit('update:modelValue', $event.target.value) ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </button>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: String,
        bg: String,
        open: Boolean,
    },
};
</script>
