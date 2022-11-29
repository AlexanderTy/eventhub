<template>
    <ul class="flex flex-row gap-2.5 z-0" >
        <Tab type="general" text="General" @tabClick="activeTab = 'general'; $emit('activeTab', 'general')"  :activeTab="activeTab"/>
        <Tab type="dates" text="Dates & Venues" @tabClick="activeTab = 'dates'; $emit('activeTab', 'dates')"  :activeTab="activeTab"/>
        <Tab type="seo" text="SEO" @tabClick="activeTab = 'seo'; $emit('activeTab', 'seo')"  :activeTab="activeTab"/>
    </ul>
</template>

<script>
import Tab from "./Tab";
export default {
    name: "TabsMenu",
    components: {Tab},
    data() {
        return {
            activeTab: 'general',
        };
    },
    methods: {

    }
}
</script>

