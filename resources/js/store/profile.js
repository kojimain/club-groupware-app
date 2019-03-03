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

const actions = {
  async fetch({ commit }) {
    return await axios.get("/api/profile").then(response => {
      commit("set", response.data);
    });
  },
  async update({ commit }, profile) {
    return await axios.post("/api/profile", profile).then(() => {
      commit("set", profile);
    });
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions
};
