import { login } from '@/api/user';
import { getToken, setToken } from '@/utils/auth';

const state = {
  token: getToken(),
  email: '',
  name: '',
};

const mutations = {
  SET_TOKEN: (_state, token) => {
    _state.token = token;
  },
  SET_INFO: (_state, info) => {
    _state.email = info.email;
    _state.name = info.name;
  },
};

const actions = {
  async login({ commit }, payload) {
    const { email, password } = payload;
    try {
      const { token } = await login({ email: email.trim(), password });
      commit('SET_TOKEN', token);
      setToken(token);
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
