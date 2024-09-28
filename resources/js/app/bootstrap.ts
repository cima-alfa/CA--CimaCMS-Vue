/* eslint "vue/multi-word-component-names": "off", "vue/no-reserved-component-names": "off" */
import { createApp, type DefineComponent, h } from "vue";
import { createInertiaApp, Head } from "@inertiajs/vue3";
import { route as routeFn, type Config, type RouteParams } from "@ziggy/ziggy";

import Link from "@app/views/Components/Link.vue";
import ControlPanelMainLayout from "@control-panel/views/Layouts/Main.vue";
// import FrontMainLayout from "@front/views/Layouts/Main.vue";

declare global {
    const FrontMainLayout: typeof ControlPanelMainLayout;
    const $route: typeof routeFn;
    const route: typeof routeFn;
    const $permalink: typeof routeFn;
    const permalink: typeof routeFn;
}

declare module "vue" {
    interface ComponentCustomProperties {
        $route: typeof routeFn;
        route: typeof routeFn;
        $permalink: typeof routeFn;
        permalink: typeof routeFn;
    }
}

createInertiaApp({
    resolve: (name: string | RegExpMatchArray) => {
        name = (<string>name).match(/^(CP|Front)\/(.+)/);
        name[1] = name[1] === "CP" ? "ControlPanel" : name[1];

        const pages =
            name[1] === "ControlPanel"
                ? import.meta.glob<DefineComponent>(
                      "../../views/ControlPanel/Pages/**/*.vue",
                      {
                          eager: true,
                      }
                  )
                : import.meta.glob<DefineComponent>(
                      "../../views/Front/Pages/**/*.vue",
                      {
                          eager: true,
                      }
                  );
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

        let link: string;
        const _route = (
            name: any,
            params: RouteParams<any>,
            absolute: boolean,
            config: Config
        ) => {
            try {
                return (link = routeFn(name, params, absolute, config)) === ""
                    ? "/"
                    : link;
            } catch (e) {
                console.error(e.message);

                return "#url-error";
            }
        };

        inertiaApp.mixin({
            methods: {
                $route: (
                    name: any,
                    params: RouteParams<any>,
                    absolute: boolean,
                    config: Config
                ) => _route(name, params, absolute, config),
                route: (
                    name: any,
                    params: RouteParams<any>,
                    absolute: boolean,
                    config: Config
                ) => _route(name, params, absolute, config),
                $permalink: (
                    location = "",
                    params: RouteParams<any>,
                    absolute: boolean,
                    config: Config
                ) =>
                    _route(
                        "pages.show",
                        { permalink: location, ...params },
                        absolute,
                        config
                    ),
                permalink: (
                    location = "",
                    params: RouteParams<any>,
                    absolute: boolean,
                    config: Config
                ) =>
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
