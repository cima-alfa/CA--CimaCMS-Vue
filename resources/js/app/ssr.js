import createServer from "@inertiajs/vue3/server";
import { renderToString } from "vue/server-renderer";
import { createSSRApp, h } from "vue";

import { createInertiaApp, Head, Link } from "@inertiajs/vue3";

import { route } from "../../../vendor/tightenco/ziggy/src/js";

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) => {
            const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
            return pages[`./Pages/${name}.vue`];
        },
        setup({ App, props, plugin }) {
            const Ziggy = {
                ...props.initialPage.props.ziggy,
                location: new URL(props.initialPage.props.ziggy.url),
            };

            const inertiaApp = createSSRApp({ render: () => h(App, props) });

            inertiaApp.use(plugin);

            inertiaApp.mixin({
                methods: {
                    $route: (name, params, absolute, config = Ziggy) =>
                        route(name, params, absolute, config),
                    route: (name, params, absolute = false, config = Ziggy) =>
                        route(name, params, absolute, config),
                },
            });

            inertiaApp.component("Head", Head).component("Link", Link);

            return inertiaApp;
        },
    })
);
