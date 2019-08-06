import request from '@/utils/request';

export function getNotification(userId) {
  return request({
    url: `api/users/${userId}/notifications`,
    method: 'get',
  });
}

export function markAsRead(id) {
  return request({
    url: `/api/notifications/${id}`,
    method: 'patch',
    data: {
      read: true,
    },
  });
}
