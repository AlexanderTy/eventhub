<template>
    <div class="flex  items-center ">
        <div class="w-16 h-16 rounded-full bg-amber-500 mr-4"></div>
        <div class="">

            <h3 class="font-bold text-2xl capitalize">
                {{name}}
            </h3>
            <p>Admin</p>
        </div>
    </div>
</template>

<script>
export default{
    props: {
        name: String
    }
}

</script>
