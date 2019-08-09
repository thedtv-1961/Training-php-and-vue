<template>
  <div class="jumbotron">
    <div
      v-if="announcements.length"
      class="list-group"
    >
      <announcement-item
        v-for="announcement in announcements"
        :key="announcement.id"
        :item="announcement"
      />
    </div>
    <div v-else>
      <p class="text-center">
        {{ $t("user.nothingAnnouncement") }}
      </p>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { AnnouncementItem } from './components';
import typeError from '@/constant';

export default {
  name: 'Annoucements',
  components: {
    AnnouncementItem,
  },
  data() {
    return {
      getting: false,
      isGetted: false,
    };
  },
  computed: {
    ...mapGetters([
      'groups',
      'announcements',
    ]),
  },
  created() {
    this.getAnnouncements();
  },
  methods: {
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
  },
};
</script>
