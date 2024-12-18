<template>
  <nav class="navbar">
    <div class="logo">
    <a href="/" class="logo-link">
      <img src="/images/logo.PNG" alt="Terseear Art Logo" class="logo-image" />
       </a>
    </div>
    <div class="nav-links">
      <a href="#">ARTWORKS</a>
      <a href="/Up_coming">UPCOMING EVENT</a>
      <a href="#">COMMUNITY</a>
      <a href="#">ABOUT US</a>
    </div>
    <div class="auth-buttons">
      <button class="login" @click="goToLogin">Login</button>
      <button class="signup" @click="goToSignup">Sign Up</button>
    </div>

  </nav>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
  name: "Header_login",
  data() {
    return {
      csrfToken: "", // Default is false, will be updated based on auth status
    };
  },
  mounted() {


    // Get CSRF token from meta tag
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    if (metaTag) {
      this.csrfToken = metaTag.getAttribute("content");
    } else {
      console.error("Meta tag CSRF token not found.");
    }
  },
  methods: {

    goToLogin() {
      router.visit('/Login');
    },
    // Redirect to the signup page
    goToSignup() {
      router.visit('/Register');
    },

  }
};
</script>

<style scoped>
.logo {
  display: flex;
  align-items: center;
}

.logo-image {
  height: 50px; /* Sesuaikan ukuran gambar */
  width: auto; /* Pertahankan rasio aspek gambar */
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #001B2A;
  color: #fff;
  padding: 10px 50px;
}



.logo span {
  color: orange;
}

.logo-link {
  display: inline-block;
  text-decoration: none;
}
.navbar .nav-links a {
  margin: 0 15px;
  color: #fff1cc !important;
  text-decoration: none;
}

.auth-buttons button {
  margin-left: 10px;
  border: none;
  padding: 8px 15px;
  border-radius: 5px;
  cursor: pointer;
}

.login {
  background: #001B2A;
  color: #fff1cc;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08); /* Shadow effect */
  transition: box-shadow 0.3s ease; /* Smooth transition */
}

.login:hover {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1); /* Darker shadow on hover */
}

.signup {
  background: orange;
  color: #000;
}
</style>
