const getters = {
  hello: state => state.app.hello,
  user: state => state.profile.user,
  groups: state => state.profile.groups,
};
export default getters;
