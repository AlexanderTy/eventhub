import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import route from "ziggy-js";
import moment from "moment";

InertiaProgress.init();

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });

        const Ziggy = {
            ...props.initialPage.props.ziggy,
            location: window.location,
        };

        moment.locale(props.initialPage.props.locale);

        vueApp.mixin({
            methods: {
                $route: (name, params, absolute, config = Ziggy) =>
                    route(name, params, absolute, config),
                $date: (date, format = "ll") =>
                    date ? moment(date).format(format) : "",
                $time: (time, format = 'HH:mm') => time ? moment(time).format(format) : '',
            },
        });

        vueApp.use(plugin).mount(el);
    },
});
