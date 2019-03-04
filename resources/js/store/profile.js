import axios from "axios";

const state = {
  name: null,
  email: null
};

const mutations = {
  set(state, profile) {
    state.name = profile.name;
    state.email = profile.email;
  }
};

/**
 * コンポーネントからはこちらを利用すること
 * (mutationsは直接操作しない方針)
 */
const actions = {
  async fetch({ commit }) {
    const response = await axios.get("/api/profile");
    commit("set", response.data);
    return response;
  },
  async update({ commit }, profile) {
    const response = await axios.post("/api/profile", profile);
    commit("set", profile);
    return response;
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions
};
