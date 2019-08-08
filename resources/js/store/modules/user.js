import { login, signUp, getInfo, signOut } from '@/api/user';
import { getToken, setToken, removeToken } from '@/utils/auth';

const state = {
  accessToken: getToken(),
  tokenType: '',
  expiresAt: '',
  user: {},
  groups: [],
};

const mutations = {
  SET_TOKEN: (_state, token) => {
    _state.accessToken = token.accessToken;
    _state.expiresAt = token.expiresAt;
  },
  SET_INFO: (_state, info) => {
    _state.user = info;
  },
};

const actions = {
  async login({ commit }, payload) {
    const { email, password } = payload;
    try {
      const { accessToken, expiresAt, user } = await login({ email: email.trim(), password });
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      setToken(accessToken);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async signUp({ commit }, payload) {
    try {
      const { accessToken, expiresAt, user } = await signUp({ ...payload });
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      setToken(accessToken);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async getInfo({ commit }) {
    try {
      const { accessToken, expiresAt, user } = await getInfo();
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      return Promise.resolve(user);
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async logout({ commit }) {
    try {
      await signOut();
      commit('SET_TOKEN', '');
      removeToken();
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  resetToken({ commit }) {
    return new Promise(resolve => {
      commit('SET_TOKEN', '');
      removeToken();
      resolve();
    });
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
