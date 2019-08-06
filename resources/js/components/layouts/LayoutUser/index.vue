<template>
  <div>
    <the-header />
    <main class="container">
      <app-main />
    </main>
  </div>
</template>

<script>
import { TheHeader, AppMain } from './components';

export default {
  name: 'LayoutUser',
  components: {
    TheHeader,
    AppMain,
  },
};
</script>

<style>

</style>
