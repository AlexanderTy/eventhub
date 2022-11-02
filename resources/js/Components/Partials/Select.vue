<template>

    <select
        @change="$emit('update:modelValue', $event.target.value)"
        v-model="modelValue"
        class="border w-full rounded h-full w-full shadow px-2 py-1 cursor-pointer"
    >
        <option v-for="role in roles"  :selected="role === 'user'">{{ role }}</option>
    </select>

</template>
<script>

export default {


    props: {
        roles: Object,
        modelValue: String,

    },


}
</script>
