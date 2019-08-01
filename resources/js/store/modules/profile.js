const state = {
  user: {
    id: 1,
    name: 'David Vila',
    email: 'sample@mail.com',
    birthday: '01/01/1996',
    gender: 'Male',
    phone: '0708 456 321',
    address: '123 Bach Dang, Da Nang',
    avatar: 'https://via.placeholder.com/200',
  },
  groups: [
    {
      id: 1,
      name: 'Group Tiger',
    },
    {
      id: 2,
      name: 'Group Yasuo',
    },
    {
      id: 3,
      name: 'Group Lysandra',
    },
  ],
};

const mutations = {
  // TODO Handle change state
};

const actions = {
  // TODO Do fucking awesome here
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
