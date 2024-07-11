const {Component} = Shopware;

Shopware.Component.extend('scop-custom-header-create', 'scop-custom-header-details', {

    methods: {
        getHeader() {
            this.header = this.headerRepository.create(Shopware.Context.api);
        },

        onClickSave() {
            this.isLoading = true;

            this.repository.save(this.header, Shopware.Context.api).then(() => { //Creating new Header
                this.getHeader();
                this.isLoading = false;
                this.processSuccess = true;

            }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: this.$tc('scopcustomheader.general.errorTitle'),
                    message: exception
                })
            });
        },
    }

});
