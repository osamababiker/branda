<template>
  <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
    <div class="card-header">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" placeholder="بحث عن مستخدم" name="" class="form-control search">
      </div>
    </div>
    <div class="card-body contacts_body">
      <ul class="contacts">
        <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
          <div class="d-flex bd-highlight">
            <div class="img_cont">
              <img src="images/avatar2.png" :alt="contact.name" class="rounded-circle user_img">
              <span class="online_icon"></span>
            </div>
            <div class="user_info">
              <span>{{ contact.name }}</span>
              <p class="unread" v-if="contact.unread">{{ contact.unread }} رسالة غير مقروءة</p>
            </div>

          </div>
        </li>
      </ul>
    </div>
    <div class="card-footer"></div>
  </div>
</div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;

                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        }
    }
</script>

<style>
  .selected{
    background-color: #f1f1f1;
  }
</style>
