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
          <a
            class="nav-link"
            href="#"
          >{{ $t("route.notifications") }}</a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            href="#"
          >{{ $t("route.groups") }}</a>
        </li>
        <li class="nav-item">
          <button class="btn btn-secondary">
            {{ $t("auth.signOut") }}
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'TheHeader',
};
</script>

<style lang='scss' scoped>
.header {
  margin-bottom: 1.5rem;
}
</style>
