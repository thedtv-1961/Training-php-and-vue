<template>
  <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
    <div class="d-flex w-100 justify-content-between">
      <small class="d-block w-100 text-right">Created at: {{ createdAt }}</small>
    </div>
    <p class="mb-1">
      {{ item.content }}
    </p>
    <small class="text-muted">Group's Name</small>
  </div>
</template>

<script>
export default {
  name: 'AnnouncementItem',
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  computed: {
    createdAt() {
      return new Date(this.item.createdAt).toDateString();
    },
  },
};
</script>
