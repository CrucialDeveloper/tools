<template>
  <div class="bg-gray-700 h-screen w-screen flex items-center justify-center">
    <div
      class="container mx-auto bg-white shadow-xl rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/4"
    >
      <div class="mb-4">
        <label class="block text-grey-800 text-sm font-bold mb-2" for="username">Username</label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-800"
          id="username"
          type="text"
          placeholder="Username"
        />
      </div>
      <div class="mb-6">
        <label class="block text-grey-800 text-sm font-bold mb-2" for="password">Password</label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-800 mb-3"
          id="password"
          type="password"
          placeholder="******************"
        />
        <p class="text-red text-xs italic">Please choose a password.</p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          type="button"
        >Sign In</button>
        <a
          class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker"
          href="#"
        >Forgot Password?</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>