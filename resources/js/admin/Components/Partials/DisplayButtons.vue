<template>
    <form class="flex flex-row items-center gap-2.5">
        <button
            :class="
                form.displayBtns === 'cards' ? 'text-primary' : 'text-gray-400'
            "
            type="button"
            @click="
                btnClick('cards');
                $emit('btnClick', 'cards');
            "
        >
            <svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 22 18"
                xmlns="http://www.w3.org/2000/svg"
            >
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                    y="10"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                    x="8"
                    y="10"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                    x="16"
                    y="10"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                    x="16"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                    x="8"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="8"
                    width="6"
                />
            </svg>
        </button>
        <button
            :class="
                form.displayBtns === 'list' ? 'text-primary' : 'text-gray-400'
            "
            type="button"
            @click="
                btnClick('list');
                $emit('btnClick', 'list');
            "
        >
            <svg
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 15"
                xmlns="http://www.w3.org/2000/svg"
            >
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="3"
                    width="20"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="3"
                    width="20"
                    y="6"
                />
                <rect
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    height="3"
                    width="20"
                    y="12"
                />
            </svg>
        </button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                ...this.$page.props.profile.settings,
                displayBtns:
                    this.$page.props.profile.settings?.displayBtns ?? "cards",
            }),
        };
    },
    mounted() {

    },
    methods: {
        btnClick(e) {
            this.form.displayBtns = e;
            this.form
                .transform((data) => ({
                    ...data,
                    _method: "patch",
                }))
                .post(this.$route("admin::user.saveSettings"));
        },
    },
};
</script>
