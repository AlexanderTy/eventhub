<template>
    <div class="flex flex-col relative mb-2">
        <label v-if="label" class="text-xs text-g mb-2">{{ label }}</label>
        <slot />
        <InputError :message="error" />
    </div>
</template>
<script>
import Input from "./Input";
import InputError from "./InputError";
export default {
    components: { InputError, Input },
    props: {
        label: String,
        error: String,
    },
};
</script>
