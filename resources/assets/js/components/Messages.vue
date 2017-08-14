<template>
  <div class="card mt-3">
    <div class="collapse" id="messages">
      <div v-for="message in messages">
          <div class="card-block">
            <a href="#">{{ message.user.name }}</a> dijo: {{ message.content }}
          </div>
          <div class="card-footer text-muted">
            {{ message.created_at }}
          </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ['id'],
    data() {
      return {
        messages: [],
      }
    },
    mounted(){
      axios.get('/api/articulos/'+ this.id +'/messages')
        .then(res => {
            this.messages = res.data

            Echo.private('')

            Echo.private(`App.Articulo.${this.id}`)
    					.notification(notification => {
    						this.notifications.unshift(notification);
    					});
        });
    }
  }
</script>
