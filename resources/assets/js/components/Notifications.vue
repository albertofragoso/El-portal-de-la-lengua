<template>
  <div class="dropdown-menu">
    <div v-for="notification in notifications">
        <a :href="'/articulos/' + notification.data.articulo.id" class="dropdown-item" v-if="notification.data.articulo">
          {{ notification.data.user.name }} ha comentado tu artículo:<br> {{ notification.data.articulo.titulo }}
        </a>
        <a :href="'/conversaciones/' + notification.data.conversacion.id" class="dropdown-item" v-else>
          {{ notification.data.user.name }} ha respondido tu duda: <br> {{ notification.data.conversacion.titulo }}
        </a>
        <hr>
    </div>
    <a href="/notificaciones" class="dropdown-item">
      <b>Ver todas las notificaciones</b>
    </a>
  </div>
</template>

<script>
  export default {
    props: ['user'],
    data() {
      return {
        notifications: [],
      }
    },
    mounted() {
      axios.get('/api/notifications')
        .then(res => {
          this.notifications = res.data;

          Echo.private(`App.User.${this.user}`)
  					.notification(notification => {
  						this.notifications.unshift(notification);
  					});
        });
    }
  }
</script>
