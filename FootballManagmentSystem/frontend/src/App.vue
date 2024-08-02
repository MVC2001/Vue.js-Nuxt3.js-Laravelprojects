

<template>
  <div>
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/ourshop">Shop</router-link>|
      <router-link to="/ourgrounds">On-Trending</router-link>|
      <router-link to="/about">About</router-link>|
      <router-link to="/contactus">Contact-Us</router-link>|
      <router-link to="/register">Register</router-link>|
      <router-link to="/login">Login</router-link>
    </nav>
    <router-view />
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
  background-color: white;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
