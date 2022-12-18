<template>

    <select
        multiple
        @change="$emit('update:modelValue', $event.target.value)"
        v-model="modelValue"
        class=" w-full px-2 py-1 cursor-pointer rounded  shadow-[5px_4px_17px_-2px_rgba(0,0,0,0.15)]"
    >
            <option v-for="(value, key) in options" :key="key" :value="key" >{{ value }}</option>
    </select>

</template>
<script>

export default {


    props: {
        options: Object,
        modelValue: Array,
    },


}
</script>
