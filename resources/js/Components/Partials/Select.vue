<template>

    <select
        @change="$emit('update:modelValue', $event.target.value)"
        v-model="modelValue"
    >
        <option v-for="role in roles" >{{ role }}</option>
    </select>

</template>
<script>

export default {


    props: {
        roles: Object,
        modelValue: String,

    }

}
</script>
