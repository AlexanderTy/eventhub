<template>
    <div class="flex items-center">
        <div class="w-12 h-12 rounded-full bg-gray-500 cursor-pointer mr-4"></div>
        <div class="text-black capitalize mr-5">
            <p class="text-sm font-semibold">
                {{ $page.props.profile.first_name }} {{ $page.props.profile.last_name }}
            </p>
            <p class="text-xs">
                {{ $page.props.profile.role }}
            </p>
        </div>
        <div class="text-black mr-14">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    props: {},
};
</script>
