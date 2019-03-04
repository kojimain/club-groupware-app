const state = {
  type: null, // is-primary, is-danger, ...
  message: null
};

const mutations = {
  clear(state) {
    state.type = null;
    state.message = null;
  },
  set(state, payload) {
    state.type = payload.type;
    state.message = payload.message;
  }
};

/**
 * コンポーネントからはこちらを利用すること
 * (mutationsは直接操作しない方針)
 */
const actions = {
  clear({ commit }) {
    commit("clear");
  },
  async update({ commit, dispatch }, payload) {
    await dispatch("clear");
    commit("set", payload);
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions
};
