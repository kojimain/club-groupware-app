const state = {
  type: null, // is-primary, is-danger, ...
  message: null
};

const mutations = {
  clear(state) {
    state.type = null;
    state.message = null;
  },
  setSuccess(state, message) {
    state.type = "is-primary";
    state.message = message;
  },
  setError(state, message) {
    state.type = "is-danger";
    state.message = message;
  }
};

export default {
  namespaced: true,
  state,
  mutations
};
