<template>
  <div>
    <div
      v-if="items.length"
      class="wrapper list-group"
    >
      <a
        v-for="item in items"
        :key="item.id"
        class="list-group-item"
        @click="$emit('view-detail', item.id)"
      >
        <p class="list-group-item-text">
          {{ item.content }}
        </p>
      </a>
    </div>
    <p v-else>
      {{ $t("user.nothingAnnouncement") }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'Announcememt',
  props: {
    items: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
};
</script>

<style lang="scss" scoped>
@import '../../../../sass/_variables.scss';

.wrapper {
  max-height: 300px;
  overflow-x: hidden;
  overflow-y: scroll;

  a:hover {
    cursor: pointer;
    background-color: $cyan;
  }
}
</style>
