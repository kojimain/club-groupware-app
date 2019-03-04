import Vue from "vue";
import Vuex from "vuex";

import flash from "./flash";
import profile from "./profile";
import club from "./club";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    flash,
    profile,
    club
  }
});

export default store;
