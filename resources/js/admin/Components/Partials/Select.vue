<template>

    <select
        @change="$emit('update:modelValue', $event.target.value)"
        v-model="modelValue"
        class="rounded  w-full px-2 py-1 cursor-pointer bg-white-secondary text-gray-600 placeholder:text-placeholder"
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
