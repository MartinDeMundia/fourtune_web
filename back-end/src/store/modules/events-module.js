import service from '@/store/services/events-service';

const state = {
    events: null,
};

const mutations = {
  SET_RESOURCE: (state, events) => {
    state.events = events;
  }
};

const actions = {
    events({commit, dispatch}, params) {
    return service.get(params)
      .then((events) => {
        commit('SET_RESOURCE', events.list);
      });
  },

  update({commit, dispatch}, params) {
    return service.update(params)
      .then((events) => {
        commit('SET_RESOURCE', events);
      });
  },
};

const getters = {
    events: state => state.events
};

const events = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};

export default events;
