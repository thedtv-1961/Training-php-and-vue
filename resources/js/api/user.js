import request from '@/utils/request';

export function login(data) {
  return request({
    url: '/api/auth/login',
    method: 'post',
    data: {
      email: data.email,
      password: data.password,
    },
  });
}

export function signUp(data) {
  return request({
    url: 'api/auth/register',
    method: 'post',
    data,
  });
}

export function signOut() {
  return request({
    url: 'api/auth/logout',
    method: 'delete',
  });
}

export function getInfo() {
  return request({
    url: 'api/auth/user',
    method: 'get',
  });
}

export function announcements() {
  return request({
    url: '/api/announcements',
    method: 'get',
  });
}

export function announcementDetail() {
  return request({
    url: '/api/announcements',
    method: 'get',
  });
}

export function getGroups() {
  return request({
    url: '/api/groups',
    method: 'get',
  });
}

export function changeEmail(data) {
  return request({
    url: 'api/change-email-request',
    method: 'post',
    data,
  });
}
