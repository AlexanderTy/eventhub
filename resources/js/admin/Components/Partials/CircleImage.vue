<template>
    <div class="relative text-tab-secondary bg-tab-secondary rounded-full shrink-0 overflow-hidden"
    :class="size === 'large' ? 'w-32 h-32' : size === 'medium' ? 'w-10 h-10' : size === 'small' ? 'w-8 h-8' : ''">
        <img v-if="artist?.image" alt="" class="w-full h-full object-cover object-top shadow-[inset_0_0_18px_rgba(0,0,0,0.1)]" :src="'/storage/images/artists/' + artist.image"/>
        <img v-else-if="user?.image" alt="" class="w-full h-full object-cover object-top shadow-[inset_0_0_18px_rgba(0,0,0,0.1)]" :src="'/storage/images/users/' + user.image"/>
        <svg v-else class="w-full h-full bg-white" viewBox="0 0 167 167" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M140.751 144.279C149.05 136.482 155.661 127.065 160.176 116.611C164.69 106.156 167.013 94.8873 167 83.5C167 37.3823 129.618 0 83.5 0C37.3823 0 5.57455e-05 37.3823 5.57455e-05 83.5C-0.0131202 94.8873 2.30951 106.156 6.82436 116.611C11.3392 127.065 17.9503 136.482 26.249 144.279C41.7238 158.897 62.2126 167.029 83.5 167C104.787 167.029 125.276 158.897 140.751 144.279ZM55.6807 115.512C46.9999 119.681 39.3699 125.752 33.3572 133.275C39.9171 139.901 47.7273 145.158 56.3349 148.742C64.9425 152.326 74.176 154.166 83.5 154.154C92.824 154.166 102.058 152.326 110.665 148.742C119.273 145.158 127.083 139.901 133.643 133.275C127.63 125.752 120 119.681 111.319 115.512C102.639 111.343 93.1301 109.183 83.5 109.192C73.87 109.183 64.3615 111.343 55.6807 115.512ZM106.209 80.5167C112.232 74.4939 115.615 66.3252 115.615 57.8077C115.615 49.2901 112.232 41.1215 106.209 35.0987C100.186 29.0759 92.0175 25.6923 83.5 25.6923C74.9825 25.6923 66.8138 29.0759 60.791 35.0987C54.7682 41.1215 51.3846 49.2901 51.3846 57.8077C51.3846 66.3252 54.7682 74.4939 60.791 80.5167C66.8138 86.5395 74.9825 89.923 83.5 89.923C92.0175 89.923 100.186 86.5395 106.209 80.5167Z"/>
        </svg>
        <div class="absolute w-full h-full rounded-full top-0 left-0 shadow-[inset_0_0_18px_rgba(0,0,0,0.1)]"></div>
    </div>
</template>

<script>
export default {
    props: {
        artist: Object,
        user: Object,
        size: String,
    }
}
</script>

<style scoped>

</style>
