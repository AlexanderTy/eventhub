<template>
    <div class="flex flex-row items-center gap-2.5">
        <button @click="selectedButton = 'cards';$emit('btnClick', 'cards')"  :class="selectedButton === 'cards' ? 'text-primary' : 'text-gray-400'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 18" fill="currentColor" class="w-5 h-5">
                <rect fill-rule="evenodd" y="10" width="6" height="8" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" x="8" y="10" width="6" height="8" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" x="16" y="10" width="6" height="8" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" x="16" width="6" height="8" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" x="8" width="6" height="8" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" width="6" height="8" clip-rule="evenodd"/>
            </svg>
        </button>
        <button @click="selectedButton = 'list'; $emit('btnClick', 'list')"  :class="selectedButton === 'list' ? 'text-primary' : 'text-gray-400'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 15" fill="currentColor" class="w-5 h-5" >
                <rect fill-rule="evenodd" width="20" height="3" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" y="6" width="20" height="3" clip-rule="evenodd"/>
                <rect fill-rule="evenodd" y="12" width="20" height="3" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

</template>

<script>
export default {
    data() {
        return {
            selectedButton: 'cards',
        }
    }
}
</script>

