<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="bg-gray-100 rounded-full px-2 "
    />
</template>

<script>
export default {
    props:{
        modelValue: String,
    }
}


</script>
