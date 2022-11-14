<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="border border-black shadow rounded px-2 py-1"

    />
</template>

<script>
export default {
    props:{
        modelValue: String,
    }
}


</script>
