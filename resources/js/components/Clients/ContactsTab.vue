<template>
  <div>
    <div v-for="contact in contacts" :key="contact.id">
      <
    </div>
  </div>
</template>

<script>
import Form from "@johnlowery74/crucial-form";

export default {
  components: { Form },
  props: ["contacts"],
  data() {
    return {
      editedContacts: new Form({
        first_name: "",
        last_name: "",
        email: "",
        address: "",
        city: "",
        state: "",
        zip: "",
        phone_number: ""
      })
    };
  },
  created() {
      this.co
  }
};
</script>