
 <template>

    <button
        :class="{
            'bg-gray-600 hover:bg-gray-800 rounded-full': type === 'back' || type === 'cancel',
            'bg-primary hover:brightness-75 rounded-full': type === 'submit',
            'bg-red-600 hover:bg-red-700 rounded-full': type === 'delete',
            'bg-primary hover:bg-red-700 flex flex-row items-center justify-center gap-2 rounded-full': type === 'create',
            'bg-white text-black font-normal flex flex-row items-center justify-between px-3 w-44 2xl:w-52 h-9': type === 'toggleDropdown',
            'rounded-t-md': open === true,
             'rounded-md': open === false
        }"
        class="min-w-[7.5rem] px-6 py-2 text-white capitalize text-center font-semibold self-start"
        :type="type==='submit' ? 'submit' : 'button' "
        :tabindex="tabindex"
    >
        <svg v-show="type === 'create'" class="shrink-0" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.2 1.2C7.2 0.88174 7.07357 0.576516 6.84853 0.351472C6.62348 0.126428 6.31826 0 6 0C5.68174 0 5.37652 0.126428 5.15147 0.351472C4.92643 0.576516 4.8 0.88174 4.8 1.2V4.8H1.2C0.88174 4.8 0.576516 4.92643 0.351472 5.15147C0.126428 5.37652 0 5.68174 0 6C0 6.31826 0.126428 6.62348 0.351472 6.84853C0.576516 7.07357 0.88174 7.2 1.2 7.2H4.8V10.8C4.8 11.1183 4.92643 11.4235 5.15147 11.6485C5.37652 11.8736 5.68174 12 6 12C6.31826 12 6.62348 11.8736 6.84853 11.6485C7.07357 11.4235 7.2 11.1183 7.2 10.8V7.2H10.8C11.1183 7.2 11.4235 7.07357 11.6485 6.84853C11.8736 6.62348 12 6.31826 12 6C12 5.68174 11.8736 5.37652 11.6485 5.15147C11.4235 4.92643 11.1183 4.8 10.8 4.8H7.2V1.2Z" fill="white"/>
        </svg>
        {{ text ? text : type }}
        <span v-if="count" class="w-6 h-6 text-xs flex items-center justify-center rounded-full bg-primary text-white">{{ count }}</span>

        <svg v-show="type === 'toggleDropdown' && open === false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
        <svg v-show="type === 'toggleDropdown' && open === true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>

    </button>
</template>
<script>
export default {
    props: {
        open: Boolean,
        type: String,
        text: String,
        count: Number,
        tabindex: String
    },
};
</script>
