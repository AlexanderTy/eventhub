<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="bg-white-secondary rounded px-2 py-1 text-gray-600 placeholder:text-placeholder"

    />
</template>

<script>
export default {
    props:{
        modelValue: String,
    }
}


</script>
