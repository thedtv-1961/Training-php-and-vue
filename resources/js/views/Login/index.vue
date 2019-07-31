<template>
  <div class="login-container">
    <div class="login-form">
      <p class="display-4 text-center mb-4">
        {{ $t("auth.login") }}
      </p>
      <form>
        <div class="form-group">
          <label for="email">
            {{ $t("auth.emailAddress") }}
          </label>
          <input
            id="email"
            type="email"
            class="form-control"
            :placeholder="$t('auth.enterEmail')"
          >
        </div>

        <div class="form-group">
          <label for="password">
            {{ $t("auth.password") }}
          </label>
          <input
            id="password"
            type="password"
            class="form-control"
            :placeholder="$t('auth.enterPassword')"
          >
        </div>

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
