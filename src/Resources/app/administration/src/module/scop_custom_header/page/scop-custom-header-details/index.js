import template from './scop-custom-header-details.html.twig';

const {Component, Mixin, State} = Shopware;
const {Criteria} = Shopware.Data;

Component.register('scop-custom-header-details', {
    template,

    inject: [
        'repositoryFactory',
        'entityValidationService'
    ],


    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],

    props: {
        headerId: {
            type: String,
            required: false,
            default() {
                return null;
            },
        },
    },

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data() {
        return {
            header: null,
            isLoading: false,
            processSuccess: false,
        };
    },

    watch: {
        headerId() {
            this.getHeader();
        }
    },

    created() {
        if (this.isCreateMode) {
            if (!State.getters['context/isSystemDefaultLanguage']) {
                State.commit('context/resetLanguageToDefault');
            }
        }
        this.getHeader();
    },

    computed: {
        isCreateMode() {
            return this.$route.name === 'scop.custom.header.create.base';
        },

        headerRepository() {
            return this.repositoryFactory.create('scop_custom_header');
        },
        highlightInvalidColumns: {
            get() {
                return State.get('scopHeaderDetail').highlightInvalidColumns;
            },
            set(isLoading) {
                State.commit('scopHeaderDetail/setHighlightInvalidColumns', isLoading);
            },
        }
    },

    methods: {
        getHeader() {
            this.isLoading = true;


            if (!this.headerId) {
                this.header = this.headerRepository.create();

                //Default values
                this.header.label = "";
                this.header.priority = 1;
                this.header.height = 10;
                this.header.background = "#ffffff";
                this.header.textFontSize = 10;
                this.header.textColor = "#000000";
                this.header.hover = "#14b79f";
                this.header.paddingTop = 10;
                this.header.paddingBottom = 10;
                this.header.paddingLeft = 10;
                this.header.paddingRight = 10;
                this.header.mobileCarouselSpeed = 5;

                this.isLoading = false;

                return;
            }

            this.loadEntity();

        },

        loadEntity() {
            const criteria = (new Criteria(1, 1)).addAssociation('columns');

            criteria.getAssociation('columns').addSorting(Criteria.sort('createdAt', 'ASC'));

            if (!this.headerId) {
                return;
            }

            return this.headerRepository.get(this.headerId, Shopware.Context.api, criteria).then((header) => {

                if (header === null) {
                    return;
                }

                this.header = header;

                if (!this.header || !this.header.columns || this.header.length < 1) {
                    return;
                }

                State.commit('scopHeaderDetail/setHeader', this.header);

            }).finally(() => {
                this.isLoading = false;
            });
        },


        onClickSave() {
            if (!this.headerId) {
                this.createHeader();
                return;
            }

            this.saveHeader();
        },

        createHeader() {
            return this.saveHeader().then(() => {
                if (this.processSuccess)
                    this.$router.push({name: 'scop.custom.header.details', params: {id: this.header.id}})
            })
        },

        saveHeader() {
            this.isLoading = true;

            if (!this.entityValidationService.validate(this.header)) {
                const titleSaveError = this.$tc('global.default.error');
                const messageSaveError = this.$tc(
                    'global.notification.notificationSaveErrorMessageRequiredFieldsInvalid',
                );

                this.createNotificationError({
                    title: titleSaveError,
                    message: messageSaveError,
                });

                this.isLoading = false;
                return Promise.resolve();
            }

            for (let column of this.header.columns) {
                if ((column.translated.label == null || column.translated.label === '') && column.translated.iconId == null) {
                    const titleSaveError = this.$tc('global.default.error');
                    const messageSaveError = this.$tc('scopcustomheader.detail.columns.invalidSave');

                    this.createNotificationError({
                        title: titleSaveError,
                        message: messageSaveError,
                    });

                    this.isLoading = false;
                    this.highlightInvalidColumns = true;
                    return Promise.resolve();
                }
            }
            this.highlightInvalidColumns = false;

            return this.headerRepository.save(this.header).then(() => { //Updating the Header in the Database
                this.processSuccess = true;
                this.loadEntity();
            }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('scopcustomheader.general.errorTitle'),
                    message: exception
                })
            });
        },

        saveFinish() {
            this.processSuccess = false;
        },

        abortOnLanguageChange() {
            return this.headerRepository.hasChanges(this.header);
        },

        saveOnLanguageChange() {
            return this.saveHeader();
        },

        onChangeLanguage(languageId) {
            State.commit('context/setApiLanguageId', languageId);
            this.getHeader();
        },

    }

});
