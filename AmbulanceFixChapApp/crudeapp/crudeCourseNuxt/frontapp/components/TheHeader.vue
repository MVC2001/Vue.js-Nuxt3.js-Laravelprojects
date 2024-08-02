<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white shadow-lg">
            <NuxtLink class="navbar-brand" to="/">Navbar</NuxtLink>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav text-white">
                <li class="nav-item active">
                  <NuxtLink to="/" class="nav-link">Home <span class="sr-only">(current)</span></NuxtLink>
                </li>
                <li class="nav-item">
                  <NuxtLink class="nav-link" to="/about">About</NuxtLink>
                </li>
                <li class="nav-item">
                  <NuxtLink class="nav-link"  to="/contact">Contact</NuxtLink>
                </li>
                <li class="nav-item">
                    <NuxtLink class="nav-link"  to="/students">Students</NuxtLink>
                  </li>
              </ul>
            </div>
          </nav>
    </div>
</template>

<script setup>

</script>

<style  scoped>

</style>