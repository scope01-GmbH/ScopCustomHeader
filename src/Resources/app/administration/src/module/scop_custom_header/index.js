import scopHeaderState from './page/scop-custom-header-details/state';

import './page/scop-custom-header-list';
import './page/scop-custom-header-details';
import './view/scop-custom-header-details-base'
import './view/scop-custom-header-details-columns'
import './component/scop-custom-header-column-component'
import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

Shopware.State.registerModule('scopHeaderDetail', scopHeaderState);

Shopware.Module.register('scop-custom-header', {
        type: 'plugin',
        name: 'scop-custom-header',
        title: 'scopcustomheader.general.title',
        description: 'scopcustomheader.general.title',
        color: '#019994',
        icon: 'regular-window-terminal',
        routes: {
            list: {
                components: {
                    default: 'scop-custom-header-list',
                },
                path: 'list'
            },
            create: {
                component: 'scop-custom-header-details',
                path: 'create',
                redirect: {
                    name: 'scop.custom.header.create.base',
                },
                children: {
                    base: {
                        component: 'scop-custom-header-details-base',
                        path: 'base',
                        meta: {
                            parentPath: 'scop.custom.header.list'
                        },
                    },
                }
            },
            details: {
                component: 'scop-custom-header-details',
                path: 'details/:id?',
                meta: {
                    parentPath: 'scop.custom.header.list'
                },
                redirect: {
                    name: 'scop.custom.header.details.base',
                },
                children: {
                    base: {
                        component: 'scop-custom-header-details-base',
                        path: 'base'
                    },
                    columns: {
                        component: 'scop-custom-header-details-columns',
                        path: 'columns'
                    }
                },
                props: {
                    default: (route) => {
                        return {
                            headerId: route.params.id,
                        }
                    }
                }
            },

        },
        settingsItem: {
            group: 'general',
            to: 'scop.custom.header.list',
            icon: 'regular-window-terminal',
            privilege: 'system.system_config',
        },
        snippets: {
            'de-DE': deDE,
            'en-GB': enGB
        }
    }
);
