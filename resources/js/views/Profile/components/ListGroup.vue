<template>
  <div>
    <ul
      v-if="items.length > 0"
      class="list-group list-group-horizontal-md"
    >
      <li
        v-for="item in items"
        :key="item.id"
        class="list-group-item list-group-item-info"
        :class="{ 'list-group-item-action': itemAction }"
        @click="$emit('viewItem', item.id)"
      >
        {{ item.name }}
      </li>
    </ul>
    <p v-else>
      {{ $t("user.nothingGroup") }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'ListGroup',
  props: {
    items: {
      type: Array,
      required: true,
    },
    itemAction: {
      type: Boolean,
      required: false,
    },
  },
};
</script>
