<template>
  <div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <div class="container">
        <!-- Logo_Icon -->
        <router-link to="/" class="navbar-brand">
          <img src="../src/assets/Logo_Icon.png" alt="Logo_Icon" class="logo" />
        </router-link>
        <!-- Toggle button for responsive navbar -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            
            <!-- Link ke halaman rumahs -->
            <li class="nav-item">
              <router-link
                :to="{ name: 'rumahs.index' }"
                class="nav-link"
                >RUMAHS</router-link
              >
            </li>
            <!-- Link ke halaman reviews -->
            <li class="nav-item">
              <router-link
                :to="{ name: 'reviews.index' }"
                class="nav-link"
                >REVIEWS</router-link
              >
            </li>
            <!-- Link ke halaman ratings -->
            <li class="nav-item">
              <router-link
                :to="{ name: 'ratings.index' }"
                class="nav-link"
                >RATINGS</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Content Area -->
    <div class="container mt-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style>
/* Styling for body */
body {
  background-color: #f8f9fa;
  font-family: 'Arial', sans-serif;
}

/* Navbar styling */
.navbar {
  margin-bottom: 20px;
}

.custom-navbar {
  background-color: #117111;
}

.custom-navbar .logo {
  height: 40px;
  width: auto;
}
</style>
