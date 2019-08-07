import axios from 'axios';
import { getToken } from './auth';
import typeError from '@/constant';

const camelcaseKeys = require('camelcase-keys');

const service = axios.create({
  baseURL: process.env.MIX_BASE_API,
  timeout: 10000,
});

function unauthenticated(error) {
  if (error.response.data.error_code === typeError.UNAUTHENTICATED) {
    // TODO SOMETHING
  }
}

function recordNotFound(error) {
  if (error.response.data.error_code === typeError.RECORD_NOT_FOUND) {
    // TODO SOMETHING
  }
}

function unauthorizedError(error) {
  if (error.response.data.error_code === typeError.UNAUTHENTICATED) {
    // TODO SOMETHING
  }
}

function badRequest(error) {
  if (error.response.data.error_code === typeError.BAD_REQUEST) {
    // TODO SOMETHING
  }
}

function crashError(error) {
  if (error.response.status === typeError.CRASH_ERROR) {
    // TODO SOMETHING
  }
}

service.interceptors.request.use(
  config => {
    const token = getToken();
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    config.headers['Access-Control-Allow-Origin'] = '*';

    return config;
  },
  error => {
    Promise.reject(error);
  }
);

service.interceptors.response.use(
  response => {
    if (response.data) {
      return camelcaseKeys(response.data);
    }
    return response;
  },
  error => {
    if (!error.response) throw Object.assign({ error_code: typeError.REQUEST_ERROR, message: 'Something went wrong!' });
    if (error.response && crashError(error)) throw error.response.data;
    if (error.response && badRequest(error)) throw error.response.data;
    if (error.response && unauthenticated(error)) throw error.response.data;
    if (error.response && recordNotFound(error)) throw error.response.data;
    if (error.response && unauthorizedError(error)) throw error.response.data;

    throw error.response.data;
    // return Promise.reject(error);
  },
);

export default service;
