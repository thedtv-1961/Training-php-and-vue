<template>
  <h1>{{ hello }}</h1>
</template>

<script>
import { mapMutations, mapGetters, mapActions } from 'vuex';
export default {
  name: 'Home',
  computed: {
    ...mapGetters({
      hello: 'hello',
    }),
  },
};
</script>

<style>

</style>
