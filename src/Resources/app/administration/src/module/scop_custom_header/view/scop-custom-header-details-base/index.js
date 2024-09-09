import template from './scop-custom-header-details-base.html.twig';

const {Component, Mixin} = Shopware;
const {mapPropertyErrors} = Shopware.Component.getComponentHelper();

Component.register('scop-custom-header-details-base', {
    template,

    mixins: [
        Mixin.getByName('placeholder'),
    ],


    props: {
        header: {
            type: Object,
            required: false,
            default() {
                return null;
            },
        },

        isLoading: {
            type: Boolean,
            required: false,
            default: false,
        },

        isCreateMode: {
            type: Boolean,
            required: true,
        },
    },

    computed: {
        ...mapPropertyErrors('header', [
            'label',
            'priority'
        ]),
    },

    data() {
        return {
            processSuccess: false,
        }
    }

});
