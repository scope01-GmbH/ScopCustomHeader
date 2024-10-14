import template from './scop-custom-header-list.html.twig';

const Criteria = Shopware.Data.Criteria;

const {Mixin} = Shopware;

Shopware.Component.register('scop-custom-header-list', {
    template,

    inject: [
        'repositoryFactory', 'syncService', 'loginService'
    ],

    mixins: [
        Mixin.getByName('notification')
    ],

    data() {
        return {
            repository: null,
            header: null,
            noHeader: true,
            page: 1,
            limit: 25
        };
    },

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    computed: {
        columns() {
            return [{
                property: 'label',
                dataIndex: 'label',
                label: this.$tc('scopcustomheader.list.label'),
                routerLink: 'scop.custom.header.details',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'enabled',
                dataIndex: 'enabled',
                label: this.$tc('scopcustomheader.list.columnEnabled'),
                inlineEdit: 'boolean'
            },
                {
                    property: 'salesChannel',
                    dataIndex: 'salesChannel',
                    label: this.$tc('scopcustomheader.list.salesChannel'),
                    allowResize: true
                },
            ];
        }
    },

    created() {
        this.repository = this.repositoryFactory.create('scop_custom_header');

        let criteria = new Criteria(this.page, this.limit);
        criteria.addAssociation('salesChannel');

        this.repository.search(criteria, Shopware.Context.api).then((result) => {
            this.header = result;
        });
    },

    methods: {
        updateList() {
            const criteria = this.header.criteria;

            this.repository.search(criteria, Shopware.Context.api).then((result) => {
                this.header = result;
            });
        },

        onUpdate(records) {
            this.noHeader = records.length === 0;
        },
    },

});
