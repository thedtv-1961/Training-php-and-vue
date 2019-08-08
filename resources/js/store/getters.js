const getters = {
  hello: state => state.app.hello,
  user: state => state.user.user,
  groups: state => state.user.groups,
  announcements: state => state.user.announcements,
};
export default getters;
