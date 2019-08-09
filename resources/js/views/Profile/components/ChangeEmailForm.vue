<template>
  <div
    id="changeEmailModal"
    class="modal fade"
    tabindex="-1"
    role="dialog"
  >
    <div
      class="modal-dialog modal-dialog-centered"
      role="document"
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            {{ $t("user.changeEmail") }}
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form
            class="form-inline"
            @submit.prevent="handleChangeEmail"
          >
            <label
              class="sr-only"
              for="email"
            >Email</label>
            <input
              id="email"
              v-model="newEmail"
              type="email"
              class="form-control mb-2 mr-sm-2"
            >

            <button
              type="submit"
              class="btn btn-primary mb-2"
            >
              {{ $t("user.send") }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'ChangeEmailForm',
  data() {
    return {
      newEmail: '',
    };
  },
  computed: {
    ...mapGetters([
      'user',
    ]),
  },
  methods: {
    async handleChangeEmail() {
      try {
        await this.$store.dispatch('user/changeEmail', { email_change: this.newEmail, user_id: this.user.id, status: 0 });
        $('#changeEmailModal').modal('hide');
        this.$toasted.success(this.$t('user.changeEmailRequestSent'));
      } catch (error) {
        if (error.error_code === 700) {
          this.$toasted.error(`${error.message}`);
        }
        this.errors = error;
      }
    },
  },
};
</script>

<style scoped>
.form-control {
  flex-grow: 1;
}
</style>
