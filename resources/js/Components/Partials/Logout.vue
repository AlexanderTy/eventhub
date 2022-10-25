<template>
    <div>
        <p>
            <Link href="/logout" method="POST" as="button" >Logout</Link>
        </p>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default{
    components: {
        Link
    }
}

</script>
