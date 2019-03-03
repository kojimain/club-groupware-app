import Vue from "vue";
import Vuex from "vuex";

import flash from "./flash";
import profile from "./profile";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    flash,
    profile
  }
});

export default store;
