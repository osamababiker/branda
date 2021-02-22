<template>
  <div class="card">
    <div class="card-header msg_head">
      <div class="d-flex bd-highlight">
        <div class="user_info">
          <span>اختر مستخدم لبدء المحادثة</span>
        </div>
      </div>
    </div>
    <div  v-if="contact" class="card-body msg_card_body">
      <div v-for="message in messages" class="d-flex justify-content-start mb-4" :key="message.id">
        <div :class="`msg_cotainer${message.to == contact.id ? ' msg_cotainer_send' : ''}`">
          <span>{{ message.message }}</span>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        }, 
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
