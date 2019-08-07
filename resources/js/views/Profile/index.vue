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
          <p><b>{{ $t("user.email") }}: </b>{{ user.email }}</p>
          <p><b>{{ $t("user.birthday") }}: </b>{{ user.birthday }}</p>
          <p><b>{{ $t("user.gender") }}: </b>{{ user.gender }}</p>
          <p><b>{{ $t("user.phone") }}: </b>{{ user.phone }}</p>
          <p><b>{{ $t("user.address") }}: </b>{{ user.address }}</p>
          <hr class="my-3 w-100">
          <h3>{{ $t("user.yourGroups") }}</h3>
          <list-group
            :items="groups"
            :item-action="true"
            @viewItem="viewGroup"
          />
          <hr class="my-3 w-100">
          <h3>{{ $t("user.yourAnnouncement") }}</h3>
          <the-announcement
            :items="announcements"
            @viewDetail="viewAnnouncement"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { ListGroup, TheAnnouncement } from './components';
import typeError from '@/constant';

export default {
  name: 'Profile',
  components: {
    ListGroup,
    TheAnnouncement,
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
      'announcements',
    ]),
  },
  created() {
    this.getAnnouncements();
  },
  methods: {
    viewGroup(id) {
      return id;
      // TODO navigate to user's group page
    },
    async getAnnouncements() {
      try {
        this.getting = true;
        await this.$store.dispatch('user/getAnnouncements');
        this.isGetted = true;
      } catch (error) {
        if (error.error_code === typeError.REQUEST_ERROR) {
          this.$toasted.error(`${error.message}`);
        }
      } finally {
        this.getting = false;
      }
    },
    viewAnnouncement(id) {
      return id;
    },
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
