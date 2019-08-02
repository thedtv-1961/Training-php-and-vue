<template>
  <div class="signup-container">
    <div class="signup-form">
      <p class="display-4 text-center mb-4">
        {{ $t("auth.signUp") }}
      </p>
      <form @submit.prevent="handleSignUp">
        <div
          class="form-group"
          :class="{ 'error': isSubmited && inValid }"
        >
          <label for="name">
            {{ $t("auth.userName") }}
          </label>
          <input
            id="name"
            v-model="signupForm.name"
            type="text"
            class="form-control"
            :placeholder="$t('auth.enterName')"
          >
        </div>

        <div
          class="form-group"
          :class="{ 'error': isSubmited && inValid }"
        >
          <label for="email">
            {{ $t("user.email") }}
          </label>
          <input
            id="email"
            v-model="signupForm.email"
            type="email"
            class="form-control"
            :placeholder="$t('auth.enterEmail')"
          >
        </div>

        <div
          class="form-group"
          :class="{ 'error': isSubmited && inValid }"
        >
          <label for="password">
            {{ $t("auth.password") }}
          </label>
          <input
            id="password"
            v-model="signupForm.password"
            type="password"
            class="form-control"
            :placeholder="$t('auth.enterPassword')"
          >
        </div>
        <div
          class="form-group"
          :class="{ 'error': isSubmited && inValid }"
        >
          <label for="confirm-password">
            {{ $t("auth.confirmPassword") }}
          </label>
          <input
            id="confirm-password"
            v-model="signupForm.confrimPassword"
            type="password"
            class="form-control"
            :placeholder="$t('auth.enterPassword')"
          >
        </div>

        <p :class="{ 'error-message': isSubmited && inValid }">
          {{ errors.error }}
        </p>

        <button
          type="submit"
          class="btn btn-primary w-100"
        >
          {{ $t("auth.signUp") }}
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SignUp',
  data() {
    return {
      signupForm: {
        name: '',
        email: '',
        password: '',
        confrimPassword: '',
      },
      submitting: false,
      isSubmited: false,
      redirect: undefined,
      errors: {},
    };
  },
  computed: {
    inValid() {
      return Object.keys(this.errors).length > 0;
    },
  },
  watch: {
    $route: {
      handler(route) {
        this.redirect = route.query && route.query.redirect;
      },
      immediate: true,
    },
  },
  methods: {
    async handleSignUp() {
      try {
        this.submitting = true;
        this.isSubmited = true;
        await this.$store.dispatch('user/signUp', this.signupForm);
        this.$router.push({ path: this.redirect || '/' });
      } catch (error) {
        this.errors = error;
      } finally {
        this.submitting = false;
      }
    },
  },
};
</script>

<style lang='scss' scoped>
@import '../../../sass/_variables.scss';

.signup-container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;

  .signup-form {
    background-color: $clounds;
    padding: 5rem 2rem;
    border-radius: 0.5rem;
    box-shadow: 3px 3px 2px 0px rgba(50, 50, 50, 0.25);
    width: 50%;
  }
}

.error input[type="email"],
.error input[type="password"],
.error input[type="text"] {
  background-color: #fce4e4;
  border: 1px solid #cc0033;
  outline: none;
}


.error-message {
  color: #cc0033;
  display: inline-block;
}

.error label {
  color: #cc0033;
}

@media (min-width: $screen-large) {
  .signup-container {
    .signup-form {
      width: 40%;
    }
  }
}

@media (min-width: $screen-extra-large) {
  .signup-container {
    .signup-form {
      width: 30%;
    }
  }
}
</style>
