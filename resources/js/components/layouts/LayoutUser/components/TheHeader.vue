<template>
  <nav class="header navbar navbar-expand-lg navbar-dark bg-dark">
    <router-link
      to="/"
      class="navbar-brand"
    >
      Training Php and Vue
    </router-link>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#collapseNav"
    >
      <span class="navbar-toggler-icon" />
    </button>

    <div
      id="collapseNav"
      class="collapse navbar-collapse"
    >
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a
            class="nav-link"
            href="#"
          >{{ $t("route.profile") }}</a>
        </li>
        <li class="nav-item">
          <the-notification />
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            href="#"
          >{{ $t("route.groups") }}</a>
        </li>
        <li class="nav-item">
          <button
            class="btn btn-secondary"
            @click="logout"
          >
            {{ $t("auth.signOut") }}
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapState } from 'vuex';

import typeError from '@/constant';
import TheNotification from './TheNotification';

export default {
  name: 'TheHeader',
  components: {
    TheNotification,
  },
  computed: {
    ...mapState({
      auth: 'user',
    }),
  },
  methods: {
    async logout() {
      try {
        await this.$store.dispatch('user/logout');
        window.Echo.leave(`App.User.${this.auth.user.id}`);
        this.$router.push('/');
      } catch (error) {
        if (error.error_code === typeError.REQUEST_ERROR) {
          this.$toasted.error(`${error.error_code}`);
        }
      }
    },
  },
};
</script>

<style lang='scss' scoped>
.header {
  margin-bottom: 1.5rem;
}
</style>
