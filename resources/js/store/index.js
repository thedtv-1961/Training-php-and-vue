import Vue from 'vue';
import Vuex from 'vuex';
import camelCase from 'camelcase';
import getters from './getters';

Vue.use(Vuex);

const modulesFiles = require.context('./modules', false, /\.js$/);

const modules = modulesFiles.keys().reduce((_modules, modulePath) => {
  const moduleName = camelCase(modulePath.replace(/^\.\/(.*)\.\w+$/, '$1'));
  const value = modulesFiles(modulePath);
  _modules[moduleName] = value.default;
  return _modules;
}, {});

const store = new Vuex.Store({
  modules,
  getters,
});

export default store;
