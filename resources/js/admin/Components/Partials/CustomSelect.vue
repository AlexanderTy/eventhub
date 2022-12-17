<template>

    <ul
        class=" w-full px-2 py-1 cursor-pointer rounded  shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]"
    >
        <li  v-for="(value, key) in options" :key="key" :value="key" >
            <button type="button" :class="active === key ? 'bg-red-500' : ''"  @click="$emit('selectOption', key)">{{ value }}
                <span v-if="sortDirection==='asc' && active === key">v</span>
                <span v-else-if="sortDirection === 'desc' && active === key " >^</span>
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
