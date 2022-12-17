<template>
    <div>
        <div class="flex flex-col">
            <label class="text-xs text-g mb-2">Upload image</label>
            <div
                class="pb-5 flex flex-col justify-center items-center text-gray-600 bg-white-secondary h-36 rounded border border-dashed border-gray-400"
                @dragover="onDragOver"
                @drop="onDrop"
                @dragleave="onDragLeave"
                :class="isDragging ? 'border-red-600' : ''"
            >
                <svg
                    class="w-16 h-16 text-tab-secondary"
                    fill="currentColor"
                    viewBox="0 0 24 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        clip-rule="evenodd"
                        d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z"
                        fill-rule="evenodd"
                    />
                </svg>
                <p>Drag & drop image</p>
                <label>
                    Or
                    <span class="text-primary font-bold hover:underline hover:cursor-pointer">upload an image</span>
                    from the computer

                <input class="hidden" type="file" @change="onFileSelected" ref="input" accept="image/*" />                </label>


            </div>
        </div>
        <div class="px-3 flex flex-row items-center mt-4 justify-between text-gray-600"
        v-show="image">
            <div class="flex flex-row gap-3 items-center">
                <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 bg-tab-secondary">
                    <img v-if="!imageSrc" :src="image ? '/images/artists/' + image : ''"  class="w-full h-full object-cover object-top" alt="Artist Profile Pitcure"/>
                    <img v-else :src="imageSrc" class="w-full h-full object-cover object-top" alt="Artist Profile Picture" />
                </div>
                <p v-if="!image">No image</p>
                <p v-else-if="!imageSrc" >{{image}}</p>
                <p v-else >{{image.name }}</p>
            </div>
            <button type="button" @click="removeUploadedImage">
            <svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    clip-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                    fill-rule="evenodd"
                />
            </svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: String
    },
    data() {
        return {
            imageSrc: null,
            isDragging: false,
        };
    },
    mounted() {
       console.log(this.imageSrc);
    },
    methods:{
        onDragOver(e) {
            e.preventDefault();
            console.log(e)
            this.isDragging = true;

        },
        onDragLeave(e) {
            e.preventDefault();
            this.isDragging = false;
        },
        onDrop(e) {
            e.preventDefault();
            this.isDragging = false;
            const files = e.dataTransfer.files;
            if (files.length === 0) return;

            const file = e.dataTransfer.files[0];

            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
            };
            reader.readAsDataURL(file)
            this.$emit('imageUploaded', file);

        },
        onFileSelected(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;

            };

            reader.readAsDataURL(file)
            this.$emit('imageUploaded', file);
        },
        removeUploadedImage() {
            this.imageSrc = null;
            this.$refs.input.value = null;
            this.$emit('imageRemoved');
        }
    }
};
</script>
