<template>
  <nav class="navbar">
    <div class="logo">
      <a href="/" class="logo-link">
        <img src="/images/logo.PNG" alt="Terseear Art Logo" class="logo-image" />
      </a>
    </div>

    <div class="nav-links">
      <a href="/add_event">Add Event</a>
      <a href="#">ARTWORKS</a>
      <a href="/Up_coming">UPCOMING EVENT</a>
      <a href="#">COMMUNITY</a>
      <a href="#">ABOUT US</a>
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
      searchQuery: '',
    };
  },
  mounted() {
    this.checkAuthentication();
  },
  methods: {
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
    performSearch() {
      if (this.searchQuery.trim()) {
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
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #001B2A;
  color: #fff;
  padding: 10px 50px;
}

.logo {
  display: flex;
  align-items: center;
}

.logo-image {
  height: 50px;
  width: auto;
}

.nav-links {
  display: flex;
  gap: 20px; /* Adds space between menu items */
}

.nav-links a {
  color: #fff1cc;
  text-decoration: none;
  font-weight: 500;
}

.nav-links a:hover {
  color: orange;
}

.search-box {
  display: flex;
  align-items: center;
}

.search-input {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
  color: #000;
  width: 200px;
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
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.login:hover {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.signup {
  background: orange;
  color: #000;
}

.btn-logout {
  background: red;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-logout:hover {
  background: darkred;
}

@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    padding: 10px;
  }
  .nav-links {
    flex-direction: column;
    gap: 10px;
  }
  .search-box {
    margin-top: 10px;
  }
}
</style>
