/* eslint "vue/multi-word-component-names": "off", "vue/no-reserved-component-names": "off" */

import { createApp, h } from "vue";
import { createInertiaApp, Head } from "@inertiajs/vue3";
import { route } from "../../../vendor/tightenco/ziggy/src/js";

import Link from "../../views/Vue/Components/Link.vue";
import ControlPanelMainLayout from "../../views/ControlPanel/Layouts/Main.vue";
// import FrontMainLayout from "../../views/Front/Layouts/Main.vue";

createInertiaApp({
    resolve: (name) => {
        name = name.match(/^(CP|Front)\/(.+)/);
        name[1] = name[1] === "CP" ? "ControlPanel" : name[1];

        const pages =
            name[1] === "ControlPanel"
                ? import.meta.glob("../../views/ControlPanel/Pages/**/*.vue", {
                      eager: true,
                  })
                : import.meta.glob("../../views/Front/Pages/**/*.vue", {
                      eager: true,
                  });
        const page = pages[`../../views/${name[1]}/Pages/${name[2]}.vue`];

        let layout = ControlPanelMainLayout;

        if (name[1] !== "ControlPanel") {
            layout =
                typeof FrontMainLayout !== "undefined"
                    ? FrontMainLayout
                    : undefined;
        }

        page.default.layout = page.default.layout || layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        const inertiaApp = createApp({
            render: () => h(App, props),
        });

        inertiaApp.use(plugin);

        let link;
        const _route = (name, params, absolute, config) => {
            try {
                return (link = route(name, params, absolute, config)) === ""
                    ? "/"
                    : link;
            } catch (e) {
                console.error(e.message);

                return "#url-error";
            }
        };

        inertiaApp.mixin({
            methods: {
                $route: (name, params, absolute, config) =>
                    _route(name, params, absolute, config),
                route: (name, params, absolute = false, config) =>
                    _route(name, params, absolute, config),
                $permalink: (location = "", params, absolute, config) =>
                    _route(
                        "pages.show",
                        { permalink: location, ...params },
                        absolute,
                        config
                    ),
                permalink: (location = "", params, absolute = false, config) =>
                    _route(
                        "pages.show",
                        { permalink: location, ...params },
                        absolute,
                        config
                    ),
            },
        });

        inertiaApp.component("Head", Head).component("Link", Link);

        inertiaApp.mount(el);

        return inertiaApp;
    },
});
