<template>
  <div class="login-container">
    <div class="login-form">
      <p class="display-4 text-center mb-4">
        {{ $t("auth.login") }}
      </p>
      <form @submit.prevent="handleLogin">
        <div
          class="form-group"
          :class="{ 'error': isSubmited && inValid }"
        >
          <label for="email">
            {{ $t("auth.emailAddress") }}
          </label>
          <input
            id="email"
            v-model="loginForm.email"
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
            v-model="loginForm.password"
            type="password"
            class="form-control"
            :placeholder="$t('auth.enterPassword')"
          >
        </div>
        <p :class="{ 'error-message': isSubmited && inValid }">
          {{ errors.error }}
        </p>

        <div class="form-group form-check text-right">
          <input
            id="rememberMe"
            type="checkbox"
            class="form-check-input"
          >
          <label
            class="form-check-label"
            for="rememberMe"
          >
            {{ $t("auth.rememberMe") }}
          </label>
        </div>

        <div class="form-group text-right">
          <span>{{ $t("auth.notHaveAccountYet") }} <a href="#">{{ $t("auth.signUp") }}</a></span>
        </div>

        <button
          type="submit"
          class="btn btn-primary w-100"
        >
          {{ $t("auth.login") }}
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Login',
  data() {
    return {
      loginForm: {
        email: '',
        password: '',
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
    async handleLogin() {
      try {
        this.submitting = true;
        this.isSubmited = true;
        await this.$store.dispatch('user/login', this.loginForm);
        this.$toasted.success('Welcome to App !!!');
        this.$router.push({ path: this.redirect || '/app' });
      } catch (error) {
        if (error.error_code === 700) {
          this.$toasted.error(`${error.message}`);
        }
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

.login-container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;

  .login-form {
    background-color: $clounds;
    padding: 5rem 2rem;
    border-radius: 0.5rem;
    box-shadow: 3px 3px 2px 0px rgba(50, 50, 50, 0.25);
    width: 50%;
  }
}

.error input[type="email"],
.error input[type="password"] {
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
  .login-container {
    .login-form {
      width: 40%;
    }
  }
}

@media (min-width: $screen-extra-large) {
  .login-container {
    .login-form {
      width: 30%;
    }
  }
}
</style>
