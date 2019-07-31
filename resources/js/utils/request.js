import axios from 'axios';
import { getToken } from './auth';

const service = axios.create({
  baseURL: process.env.BASE_API,
  timeout: 10000,
});

service.interceptors.request.use(
  config => {
    const token = getToken();
    if (token) {
      config.headers['Authorization'] = 'Bearer ' + token;
    }
    config.headers['Access-Control-Allow-Origin'] = "*";

    return config;
  },
  error => {
    Promise.reject(error);
  }
);

service.interceptors.response.use(
  response => {
    return response.data;
  },
  error => {
    if (!error.response)
      throw Object.assign({ error_code: 700, message: 'Something went wrong!' });
    if (error.response && crashError(error)) throw error.response.data;
    if (error.response && unauthenticated(error)) throw error.response.data;
    if (error.response && recordNotFound(error)) throw error.response.data;
    if (error.response && unauthorizedError(error)) throw error.response.data;

    return Promise.reject(error);
  },
);

function unauthenticated(error) {
  if (error.response.data.error_code === 403) {
    // TODO SOMETHING
  }
}

function recordNotFound(error) {
  if (error.response.data.error_code === 404) {
    // TODO SOMETHING
  }
}

function unauthorizedError(error) {
  if (error.response.data.error_code === 403) {
    // TODO SOMETHING
  }
}

function crashError(error) {
  if (error.response.status === 500) {
    // TODO SOMETHING
  }
}

export default service;
