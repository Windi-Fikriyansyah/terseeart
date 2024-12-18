<template>
  <nav class="navbar">
    <div class="logo">
    <a href="/" class="logo-link">
      <img src="/images/logo.PNG" alt="Terseear Art Logo" class="logo-image" />
       </a>
    </div>
    <div class="search-box">
        <input
          type="text"
          placeholder="Search..."
          @keyup.enter="performSearch"
          v-model="searchQuery"
          class="search-input"
        />
        <button class="search-button" @click="performSearch">🔍</button>
      </div>

    <div class="nav-links">
      <a href="#">ARTWORKS</a>
      <a href="/Up_coming">UPCOMING EVENT</a>
      <a href="#">COMMUNITY</a>
      <a href="#">ABOUT US</a>
    </div>
    <div class="auth-buttons" v-if="!isAuthenticated">
      <button class="login" @click="goToLogin">Login</button>
      <button class="signup" @click="goToSignup">Sign Up</button>
    </div>
    <button v-if="isAuthenticated" class="btn-logout" @click="logout">Logout</button>

  </nav>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
  name: "Header",
  data() {
    return {
      isAuthenticated: false,
      searchQuery: '', // Default is false, will be updated based on auth status
    };
  },
  mounted() {
    // Check authentication status when component is mounted
    this.checkAuthentication();
  },
  methods: {
    // Existing methods...
    checkAuthentication() {
      if (window.laravel && window.laravel.auth && window.laravel.auth.user) {
        this.isAuthenticated = true;
      } else {
        this.isAuthenticated = false;
      }
    },
    goToLogin() {
      router.visit('/Login');
    },
    goToSignup() {
      router.visit('/Register');
    },
    logout() {
      this.$inertia.post('/logout').then(() => {
        this.isAuthenticated = false;
        router.visit('/Login');
      });
    },
    // New search method
    performSearch() {
      if (this.searchQuery.trim()) {
        // Use Inertia router to perform search
        router.visit('/search', {
          method: 'get',
          data: { query: this.searchQuery },
        });
      }
    }
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


.logo-search-container {
  display: flex;
  align-items: center;
}

.search-box {
  display: flex;
  align-items: center;
  margin-left: 20px;
}

.search-input {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
  background-color: #fff; /* Warna latar belakang input */
  color: #000; /* Warna teks input */
  width: 200px; /* Lebar kotak input */
}

.search-input:focus {
  border-color: orange;
}

.search-button {
  background: orange;
  color: #fff;
  border: none;
  padding: 5px 10px;
  margin-left: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.search-button:hover {
  background: #ffae42;
}

</style>
