<template>
    <div>
        <div class="absolute w-full h-full z-10 bg-opacity-70 bg-black flex justify-center items-center z-50"
        >
            <div class="min-w-[350px] p-12  bg-white flex justify-center items-center flex-col">
                <div class="mt-4 mb-12">
                    <p>Are you sure you want to delete {{type}}:</p>
                    <h3 class="font-bold text-xl mt-2">{{deleteItem}}</h3>
                </div>
                <div class="mb-4 flex justify-between w-full">
                    <Btn :text="'cancel'" :type="'cancel'" @click="$emit('closeModal')"/>
                    <Btn :text="'Delete'" :type="'delete'" @click="$emit('actionModal')"  />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Btn from "./Partials/Btn";

export default {
    components: { Btn },
    props: {
        text: String,
        user: Object,
        openModal: Boolean,
        type: String,
        deleteItem: String,
    },
};
</script>
