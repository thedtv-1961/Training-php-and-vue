<template>
  <layout-default>
    <div class="user jumbotron">
      <div class="row">
        <div class="col-12 col-md-4 mb-4">
          <div class="user__avatar m-auto">
            <img
              :src="user.avatar"
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
          </div>
        </div>
      </div>
    </div>
  </layout-default>
</template>

<script>
import { mapGetters } from 'vuex';
import LayoutDefault from '@/components/layouts/LayoutDefault';
import ListGroup from '@/components/ListGroup';

export default {
  name: 'Profile',
  components: {
    LayoutDefault,
    ListGroup,
  },
  computed: {
    ...mapGetters([
      'user',
      'groups',
    ]),
  },
  methods: {
    viewGroup(id) {
      return id;
      // TODO navigate to user's group page
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
