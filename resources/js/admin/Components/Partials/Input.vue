<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class=" rounded px-2 py-1 text-gray-600 placeholder:text-placeholder"
        :class="bg ? bg : 'bg-white-secondary' "

    />
</template>

<script>
export default {
    props:{
        modelValue: String,
        bg: String,
    }
}


</script>
