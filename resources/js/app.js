import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import route from 'ziggy-js';

InertiaProgress.init()

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {

        const vueApp = createApp({ render: () => h(App, props) });

        const Ziggy = {
            ...props.initialPage.props.ziggy,
            location: window.location,
        };

        vueApp
            .mixin({
                methods: {
                    $route: (name, params, absolute, config = Ziggy) => route(name, params, absolute, config),
                },
            });

        vueApp
            .use(plugin)
            .mount(el)

    },
})
