<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="bg-gray-100 rounded px-2 py-1"

    />
</template>

<script>
export default {
    props:{
        modelValue: String,
    }
}


</script>
