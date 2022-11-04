<template>

    <select
        @change="$emit('update:modelValue', $event.target.value)"
        v-model="modelValue"
        class="border w-full rounded h-full w-full shadow px-2 py-1 cursor-pointer"
    >
        <option v-for="(value, key) in options" :key="key" :value="key" >{{ value }}</option>
    </select>

</template>
<script>

export default {


    props: {
        options: Object,
        modelValue: String,

    },


}
</script>
