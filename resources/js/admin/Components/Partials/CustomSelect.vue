<template>

    <ul
        class=" w-full px-2 py-1 cursor-pointer rounded bg-white shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]"
    >
        <li  v-for="(value, key) in options" :key="key" :value="key" >
            <button type="button" :class="active === key ? 'text-primary font-semibold' : ''"  @click="$emit('selectOption', key)">{{ value }}
<!--                <span v-if="sortDirection==='asc' && active === key">v</span>-->
                <svg v-if="sortDirection==='asc' && active === key" class="text-tab-secondary w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                </svg>

                <svg v-else-if="sortDirection === 'desc' && active === key" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                </svg>


<!--                <span v-else-if="sortDirection === 'desc' && active === key" >^</span>-->
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
