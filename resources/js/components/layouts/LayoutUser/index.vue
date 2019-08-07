<template>
  <div>
    <the-header />
    <main class="container">
      <app-main />
    </main>
  </div>
</template>

<script>
import Echo from 'laravel-echo';

import { getToken } from '@/utils/auth';
import { TheHeader, AppMain } from './components';

export default {
  name: 'LayoutUser',
  components: {
    TheHeader,
    AppMain,
  },
  created() {
    window.io = require('socket.io-client');
    window.Echo = new Echo({
      broadcaster: 'socket.io',
      host: `${process.env.MIX_VUE_APP_BASE_API}:6001`,
      auth: {
        headers: {
          Authorization: `Bearer ${getToken()}`,
        },
      },
    });
  },
};
</script>

<style>

</style>
