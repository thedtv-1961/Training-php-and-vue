<template>
  <div class="user jumbotron">
    <div class="row">
      <div class="col-12 col-md-4 mb-4">
        <div class="user__avatar m-auto">
          <img
            :src="user.avatar ? user.avatar : defaultAvatar"
            alt="user's avatar"
            class="img-fluid img-thumbnail rounded-circle"
          >
        </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="user__profile">
          <h3>{{ user.name }}</h3>
          <p>
            <b>{{ $t("user.email") }}: </b>{{ user.email }}
            <button
              class="btn btn-sm btn-info ml-3"
              data-toggle="modal"
              data-target="#changeEmailModal"
            >
              {{ $t("user.changeEmail") }}
            </button>
          </p>
          <p><b>{{ $t("user.birthday") }}: </b>{{ user.birthday }}</p>
          <p><b>{{ $t("user.gender") }}: </b>{{ user.gender }}</p>
          <p><b>{{ $t("user.phone") }}: </b>{{ user.phone }}</p>
          <p><b>{{ $t("user.address") }}: </b>{{ user.address }}</p>
          <hr class="my-3 w-100">
          <h3>{{ $t("user.yourGroups") }}</h3>
          <list-group :items="groups" />
        </div>
      </div>
    </div>
    <change-email-form />
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { ListGroup, ChangeEmailForm } from './components';

export default {
  name: 'Profile',
  components: {
    ListGroup,
    ChangeEmailForm,
  },
  data() {
    return {
      defaultAvatar: 'https://via.placeholder.com/200',
      getting: false,
      isGetted: false,
    };
  },
  computed: {
    ...mapGetters([
      'user',
      'groups',
    ]),
  },
};
</script>

<style lang='scss' scoped>
@import '../../../sass/_variables.scss';

.user {
  &__avatar {
    width: 200px;
  }

  &__profile {
    padding: 0 4rem;
  }
}

@media (min-width: $screen-medium) {
  .user {
      &__profile {
      padding: 0 1rem;
    }
  }
}
</style>
