<template>
    <div class="flex items-center">
        <div
            class="w-16 h-16 rounded-full bg-br hover:bg-br-h cursor-pointer mr-4"
        ></div>
        <div class="">
            <h3 class="font-bold text-2xl capitalize">
                {{ $page.props.profile.first_name }}
                {{ $page.props.profile.last_name }}
            </h3>
            <p>{{ $page.props.profile.role }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {},
};
</script>
