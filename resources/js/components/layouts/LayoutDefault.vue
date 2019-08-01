<template>
  <div>
    <the-header />
    <main class="container">
      <slot />
    </main>
  </div>
</template>

<script>
import TheHeader from '@/components/TheHeader.vue';

export default {
  name: 'LayoutDefault',
  components: {
    TheHeader,
  },
};
</script>
