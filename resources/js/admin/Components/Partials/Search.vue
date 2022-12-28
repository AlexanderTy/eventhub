<template>
    <div
        :class="open ? 'rounded-t-md' : 'rounded-md'"
        class="flex items-center px-2 py-1 text-gray-600 placeholder:text-placeholder bg-white-secondary w-full"
    >

        <svg
            v-if="type === 'venue' && modelValue"
            class="w-5 h-5 shrink-0"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                clip-rule="evenodd"
                d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                fill-rule="evenodd"
            ></path>
        </svg>
        <svg
            v-else
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
            :placeholder="placeholder"
            :value="modelValue"
            class="bg-transparent mx-2 focus:outline-none w-full"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <button
            v-show="modelValue"
            type="button"
            @click="
                modelValue = '';
                $emit('update:modelValue', $event.target.value);
            "
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M6 18L18 6M6 6l12 12"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
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
        placeholder: String,
        type: String,
    },
};
</script>
