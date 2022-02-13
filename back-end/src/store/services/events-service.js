import axios from 'axios';
import Jsona from 'jsona';

const url = process.env.VUE_APP_API_BASE_URL;
const jsona = new Jsona();

function get() {
  return axios.get(`${url}/events`)
    .then(response => {
      return {
        list: jsona.deserialize(response.data),
        meta: response.data.meta
      };
    });
}

function update(events) {

  const payload = jsona.serialize({
    stuff: events,
    includeNames: []
  });

  const options = {
    headers: {
      'Accept': 'application/vnd.api+json',
      'Content-Type': 'application/vnd.api+json',
    }
  };

  return axios.patch(`${url}/events`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

export default {
  get,
  update
};