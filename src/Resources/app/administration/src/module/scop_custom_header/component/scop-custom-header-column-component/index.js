import template from './scop-custom-header-column-component.html.twig';
import './scop-custom-header-column-component.scss';

Shopware.Component.register('scop-custom-header-column-component', {
    template,

    inject: [
        'repositoryFactory'
    ],

    props: {
        header: {
            type: Object,
            required: true,
        },
        column: {
            type: Object,
            required: true,
        },
        error: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    data() {
        return {
            isLoading: false,
            mediaItem: null,
            mediaModalIsOpen: false,
            showDeleteModal: false
        };
    },

    computed: {
        getTitle() {
            return "USP " + this.column.position;
        },

        sortedColumns() {
            return this.header.columns.slice().sort((a, b) => a.position - b.position);
        }
    },

    created() {

    },

    methods: {
        setMediaItem({targetId}) {
            this.column.iconId = targetId;
        },

        onUnlinkIcon() {
            this.column.iconId = null;
        },

        onDropMedia(dragData) {
            this.setMediaItem({targetId: dragData.id});
        },

        onCloseModal() {
            this.mediaModalIsOpen = false;
        },

        onOpenMediaModal() {
            this.mediaModalIsOpen = true;
        },

        onSelectionChanges(mediaEntity) {
            const media = mediaEntity[0];

            this.setMediaItem({targetId: media.id})
        },

        onShowDeleteModal() {
            this.showDeleteModal = true;
        },

        onCloseDeleteModal() {
            this.showDeleteModal = false;
        },

        onConfirmDelete() {
            this.onCloseDeleteModal();

            Shopware.State.commit('scopHeaderDetail/setHighlightInvalidColumns', false);

            this.$nextTick(() => {

                while (!this.isLast(this.column)) {
                    this.onMoveDown(this.column);
                }

                this.header.columns.remove(this.column.id);
            });
        },

        isFirst(column) {
            return column.position === 1;
        },

        isLast(column) {
            return column.position === this.header.columns.length;
        },

        onMoveUp(column) {
            const currentPosition = column.position;
            this.header.columns.forEach(elem => {
                if (elem.position === currentPosition - 1) {
                    elem.position++;
                }
            })
            column.position--;
        },
        onMoveDown(column) {
            const currentPosition = column.position;
            this.header.columns.forEach(elem => {
                if (elem.position === currentPosition + 1) {
                    elem.position--;
                }
            })
            column.position++;
        },


    },
});
