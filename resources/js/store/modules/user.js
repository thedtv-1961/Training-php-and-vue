import { login, signUp } from '@/api/user';
import { getToken, setToken } from '@/utils/auth';

const state = {
  accessToken: getToken(),
  tokenType: '',
  expiresAt: '',
  user: {},
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
      const {
        access_token: accessToken,
        expires_at: expiresAt,
        user,
      } = await login({ email: email.trim(), password });
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
      const {
        access_token: accessToken,
        expires_at: expiresAt,
        user,
      } = await signUp({ ...payload });
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      setToken(accessToken);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
