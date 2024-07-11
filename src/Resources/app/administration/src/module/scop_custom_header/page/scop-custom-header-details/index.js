import template from './scop-custom-header-details.html.twig';

const {Component, Mixin} = Shopware;
const { Criteria } = Shopware.Data;

Component.register('scop-custom-header-details', {
    template,

    inject: [
        'repositoryFactory'
    ],


    mixins: [
        Mixin.getByName('notification')
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
        this.getHeader();
    },

    computed: {
        isCreateMode() {
            return this.$route.name === 'scop.custom.header.create.base';
        },

        headerRepository() {
            return this.repositoryFactory.create('scop_custom_header');
        }
    },

    methods: {
        getHeader() {
            this.isLoading = true;




            if(!this.headerId) {
                this.header = this.headerRepository.create();

                this.header.label = "";
                this.header.priority = 1;


                this.isLoading = false;

                return;
            }

            this.loadEntity();

        },

        loadEntity() {
            const criteria = (new Criteria(1, 1)).addAssociation('columns');

            criteria.getAssociation('columns').addSorting(Criteria.sort('createdAt', 'ASC'));

            if(!this.header.id){
                return;
            }

            return this.headerRepository.get(this.header.id, Shopware.Context.api, criteria).then((header) => {

                if (header === null) {
                    return;
                }

                this.header = header;

                if(!this.header || !this.header.columns || this.header.length < 1) {
                    return;
                }

                Shopware.State.commit('scopHeaderDetail/setHeader', this.header);

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
                this.$router.push({ name: 'scop.custom.header.details', params: { id: this.header.id }})
            })
        },

        saveHeader() {
            this.isLoading = true;

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

    }

});
