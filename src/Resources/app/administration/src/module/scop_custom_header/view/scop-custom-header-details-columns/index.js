import template from './scop-custom-header-details-columns.html.twig';
import './scop-custom-header-details-columns.scss';

const { Component, Mixin, State } = Shopware;

Component.register('scop-custom-header-details-columns', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('placeholder'),
    ],

    data() {

    },

    computed: {
        header() {
            return State.get('scopHeaderDetail').header;
        },
        isLoading: {
            get() {
                return State.get('scopHeaderDetail').isLoading;
            },
            set(isLoading) {
                State.commit('scopHeaderDetail/setIsLoading', isLoading);
            },
        },
        columns() {
            return State.get('scopHeaderDetail').header &&
                State.get('scopHeaderDetail').header.columns;
        },

        sortedColumns() {
            return [...this.columns].sort((a, b) => a.position - b.position);
        }
    },

    methods: {
        onAddColumn() {
            const headerColumnRepository = this.repositoryFactory.create(
                this.columns.entity,
                this.columns.source,
            )

            const newColumn = headerColumnRepository.create();
            newColumn.headerId = this.header.id;
            newColumn.position = this.columns.length + 1;

            this.columns.push(newColumn);
        },

        deleteColumn(column) {
            if (column.isNew()) {
                this.columns.remove(column.id);
                return;
            }

            this.isLoading = true;
            const headerColumnRepository = this.repositoryFactory.create(
                this.columns.entity,
                this.columns.source,
            );

            headerColumnRepository.delete(column.id, this.columns.context).then(() => {
                this.columns.remove(column.id);
                this.isLoading = false;
            });
        },

        sortColumns() {
            return [...this.columns].sort((a, b) => a.position - b.position);
        }

    },
});
