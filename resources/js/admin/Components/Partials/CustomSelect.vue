<template>

    <ul
        class="absolute z-20 w-full px-2 py-1 cursor-pointer bg-white shadow-[5px_20px_17px_-2px_rgba(0,0,0,0.15)]"
    >
        <li class="my-4 py-1 hover:bg-gray-100 rounded-md" v-for="(value, key) in options" :key="key" :value="key" >
            <button class="flex gap-1.5 items-center" type="button" :class="active === key ? 'text-primary font-semibold' : ''"  @click="$emit('selectOption', key)">
                <svg v-if="sortDirection === 'desc' && active === key" class="text-tab-secondary w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                </svg>
                <svg v-else class="text-tab-secondary w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                </svg>
                {{ value }}
            </button>
        </li>
    </ul>

</template>
<script>

export default {


    props: {
        options: Object,
        sortDirection: String,
        active: String,
    },


}
</script>
