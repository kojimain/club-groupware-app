import axios from "axios";

const state = {
  clubs: []
};

const mutations = {
  setClubs(state, clubs) {
    state.clubs = clubs;
  },
  pushClub(state, club) {
    state.clubs.push(club);
  },
  updateClub(state, newClub) {
    const clubId = newClub.id;
    const clubIndex = state.clubs.findIndex(clubInClubs => {
      return clubInClubs.id === clubId;
    });
    Object.assign(state.clubs[clubIndex], newClub);
  },
  removeClub(state, club) {
    const clubIndex = state.clubs.indexOf(club);
    state.clubs.splice(clubIndex, 1);
  }
};

/**
 * コンポーネントからはこちらを利用すること
 * (mutationsは直接操作しない方針)
 */
const actions = {
  async fetchClubs({ commit }) {
    const response = await axios.get("/api/clubs");
    const clubs = response.data.sort((a, b) => {
      return a.id - b.id;
    });
    commit("setClubs", clubs);
    return response;
  },
  async storeClub({ commit }, club) {
    const response = await axios.post("/api/clubs", club);
    commit("pushClub", response.data);
    return response;
  },
  async updateClub({ commit }, clubForm) {
    const response = await axios.patch(`/api/clubs/${clubForm.id}`, clubForm);
    commit("updateClub", response.data);
    return response;
  },
  async destroyClub({ commit }, club) {
    const response = await axios.delete(`/api/clubs/${club.id}`, club);
    commit("removeClub", club);
    return response;
  }
};

const getters = {
  findClubById: state => id => {
    return state.clubs.find(club => {
      return club.id === id;
    });
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
