import Vue from "vue";
import Vuex from "vuex";

import flash from "./flash";

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    flash
  }
});

export default store;
