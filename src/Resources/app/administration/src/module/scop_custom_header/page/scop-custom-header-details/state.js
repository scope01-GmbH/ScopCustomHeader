export default {
    namespaced: true,

    state() {
        return {
            header: null,
            isLoading: false,
        };
    },

    mutations: {
        setHeader(state, header) {
            state.header = header;
        },
        setIsLoading(state, isLoading) {
            state.isLoading = isLoading;
        },
    },
};
