<template>
  <div class="nav-link dropdown notification">
    <a
      id="dropdownMenuButton"
      class="d-flex align-items-center"
      data-toggle="dropdown"
    >
      {{ $t("route.notifications") }}
      <span class="badge badge-pill badge-info ml-2">{{ unReadNotification }}</span>
    </a>
    <div
      class="dropdown-menu dropdown-menu-right p-0 notification__list"
      aria-labelledby="dropdownMenuButton"
    >
      <div v-if="notifications.length">
        <a
          v-for="notification in notifications"
          :key="notification.id"
          class="dropdown-item d-flex align-items-center justify-content-between notification__item"
          :class="{ 'bg-info': !notification.read }"
        >
          {{ notification.message }}
          <span
            v-if="!notification.read"
            class="btn btn-dark btn-sm ml-2"
            @click="markAsRead(notification.id)"
          >
            <small>{{ $t("notification.markAsRead") }}</small>
          </span>
        </a>
      </div>
      <div v-else>
        <p class="dropdown-item m-0">
          {{ $t("notification.empty") }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { getNotification, markAsRead } from '@/api/notification';

export default {
  name: 'TheNotification',
  data() {
    return {
      notifications: [],
    };
  },
  computed: {
    ...mapState({
      auth: 'user',
    }),
    unReadNotification() {
      return this.notifications.filter(notification => !notification.read).length;
    },
  },
  created() {
    const token = this.auth.accessToken;
    if (token) {
      this.getNotification();
      window.Echo.private(`App.User.${this.auth.user.id}`)
        .listen('UserNotification', (event) => {
          this.$toasted.success(event.notification.message);
          this.notifications.unshift(event.notification);
        });
    }
  },
  methods: {
    async getNotification() {
      try {
        const response = await getNotification(this.auth.user.id);
        this.notifications = response.data;
      } catch (error) {
        this.errors = error;
      }
    },
    async markAsRead(id) {
      try {
        await markAsRead(id);
        const index = this.notifications.findIndex(noti => noti.id === id);
        this.notifications[index].read = true;
      } catch (error) {
        this.errors = error;
      }
    },
  },
};
</script>

<style lang='scss'>
.notification {
  &:hover {
    cursor: pointer;
  }

  &__list {
    max-height: 260px;
    overflow-x: hidden;
    overflow-y: auto;
  }

  &__item {
    border-top: 1px solid #d5d5d5;
    padding: 0.7rem 0.5rem;
  }
}
</style>
