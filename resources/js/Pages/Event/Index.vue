<template>
    <DefaultLayout currentRoute="events">
        <div class="flex justify-between">
            <h1 class="font-bold text-3xl mb-8">Events</h1>
            <button @click="openModal = !openModal">Create</button>
            <Teleport to="#app">
                <CreateModal
                    v-show="openModal"
                    @close-modal="openModal = false"
                />
            </Teleport>
        </div>
        <p class="mb-8">
            We've found
            <span class="text-primary font-semibold">{{ events.length }} </span> <span> {{ events.length === 1 ? "event" : "events" }}</span>
        </p>
        <div class="flex flex-wrap gap-5">
            <div
                v-for="event in events"
                class="col-span-1 bg-white w-72 h-80 rounded-2xl relative shadow-[0px_8px_21px_rgba(0,0,0,0.25)]"
            >
                <Link
                    :href="
                        $route('events.edit', {
                            event: event.id,
                        })
                    "
                >
                    <img
                        alt=""
                        class="rounded-t-2xl h-40 w-full"
                        src="/images/nikolaj_stokholm.jpg"
                    />
                    <div
                        class="text-white h-40 bg-gradient-to-t from-secondary flex flex-col justify-end px-4 py-2.5 absolute top-0 left-0 w-full"
                    >
                        <PublishedStatus :status="event.public" />
                        <h2 class="font-semibold">{{ event.title }}</h2>
                        <h3 class="text-sm">{{ event.sub_title }}</h3>
                    </div>
                    <div
                        class="flex flex-col justify-between px-4 h-40 pb-5 pt-2.5"
                    >
                        <div>
                            <h3 class="text-sm">
                                af
                                <span class="text-primary font-bold">{{
                                    event.artist
                                }}</span>
                            </h3>
                            <p class="text-xs">32 out of 32 events</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm">Sales dates</h4>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm">
                                        {{ $date(event.sale_start) }}
                                    </p>
                                    <p class="text-xs">
                                        {{ $date(event.sale_start, "HH:mm") }}
                                    </p>
                                </div>
                                <div class="self-center">-</div>
                                <div>
                                    <p class="text-sm">
                                        {{ $date(event.sale_end) }}
                                    </p>
                                    <p class="text-xs">
                                        {{ $date(event.sale_end, "HH:mm") }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>

            <div class="w-full px-12 grid gap-4 grid-cols-7 text-xs">
                <p class="col-span-2">Title</p>
                <p class="col-span-1">Artist</p>
                <p class="col-span-1 text-center">Events</p>
                <p class="col-span-1 text-center">Sale date (start)</p>
                <p class="col-span-1 text-center">Sale date (end)</p>
                <p class="col-span-1 text-center">Public</p>
            </div>
            <div class="grid gap-4 grid-cols-7 items-center col-span-1 px-12 text-sm bg-white w-full h-24 rounded-2xl shadow-[0px_8px_21px_rgba(0,0,0,0.25)] cursor-pointer transition duration-500 hover:scale-[1.01]" v-for="event in events">
                <h2 class="col-span-2 font-semibold text-base">{{ event.title }}</h2>
                <h3 class="col-span-1 font-semibold text-primary">{{ event.artist }}</h3>
                <p class="col-span-1 text-center">32/32</p>
                <div>
                    <p class="col-span-1 text-center text-xs">{{ event.sale_start }}</p>
                    <p class="col-span-1 text-center text-xs">7:00 AM</p>
                </div>
                <div>
                    <p class="col-span-1 text-center text-xs">{{ event.sale_end }}</p>
                    <p class="col-span-1 text-center text-xs">12:00 PM</p> 
                </div>
                <div v-show="status" class="col-span-1 justify-self-center text-xs h-7 w-28 bg-success-bg flex justify-center items-center rounded-full">
                    <p class="text-success font-bold">Published</p>
                </div>
                <div v-show="!status" class="col-span-1 justify-self-center text-xs h-7 w-28 bg-error-bg flex justify-center items-center rounded-full">
                    <p class="text-error font-bold">Not published</p>
                </div>
            </div>
        </div>

            
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import PublishedStatus from "../../Components/Partials/PublishedStatus";
import { Link } from "@inertiajs/inertia-vue3";
import CreateModal from "../../Components/CreateModal";

export default {
    // included child components
    components: {
        CreateModal,
        DefaultLayout,
        PublishedStatus,
        Link,
    },
    // passed from controller
    props: {
        events: Object,
        status: Boolean,
    },
     // custom set
     data() {
        return {
            open: false,
        };
    },
    data() {
        return {
            currentRoute: "",
            openModal: false,
        };
    },
};
</script>
