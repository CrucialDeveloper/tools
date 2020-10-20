<template>
  <div class="flex items-center justify-center w-screen h-screen bg-gray-700">
    <div
      class="container flex flex-col w-1/4 px-8 pt-6 pb-8 mx-auto mb-4 bg-white rounded shadow-xl"
    >
      <div class="mb-4">
        <label class="block mb-2 text-sm font-bold text-grey-800" for="username"
          >Email</label
        >
        <input
          class="w-full px-3 py-2 border rounded shadow appearance-none text-grey-800"
          id="email"
          name="email"
          type="text"
          placeholder="Email Address"
          v-model="user.email"
        />
      </div>
      <div class="mb-6">
        <label class="block mb-2 text-sm font-bold text-grey-800" for="password"
          >Password</label
        >
        <input
          class="w-full px-3 py-2 mb-3 border rounded shadow appearance-none text-grey-800"
          id="password"
          type="password"
          placeholder="******************"
          v-model="user.password"
        />
        <p class="text-xs italic text-red">Please choose a password.</p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700"
          type="button"
          @click="signIn"
        >
          Sign In
        </button>
        <a
          class="inline-block text-sm font-bold align-baseline text-blue hover:text-blue-darker"
          href="#"
          >Forgot Password?</a
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: new Form({
        email: "",
        password: "",
      }),
    };
  },
  methods: {
    signIn() {
      this.user
        .post("/login", this.user)
        .then((response) => {
          this.$inertia.visit("/clients");
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
};
</script>
