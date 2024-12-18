<template>
  <!-- Include Header -->
  <Header_login />

  <div class="login">
    <div class="login-wrapper">
      <div class="login-box">
        <h2 class="login-title">Login</h2>

         <div v-if="$page.props.flash.success" class="success-message">
          {{ $page.props.flash.success }}
        </div>

        <div v-if="$page.props.flash.error" class="flash-message error">
          {{ $page.props.flash.error }}
        </div>

        <div class="input-container">
          <input
            v-model="username"
            type="text"
            placeholder="Username"
            class="input-field"
          />
        </div>
        <!-- Password Input -->
        <div class="input-container">
          <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="input-field"
          />
        </div>
        <!-- Submit Button -->
        <button class="btn-submit" @click="login">Login</button>
      </div>
    </div>
  </div>

  <!-- Include Footer -->
  <Footer />
</template>

<script>
import Header_login from "./Header_login.vue";
import Footer from "./Footer.vue";

export default {
  name: "Login",
  components: {
    Header_login,
    Footer,
  },
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    login() {
      // Handle login with Inertia
      if (this.username && this.password) {
        // Menambahkan CSRF token ke header permintaan
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        this.$inertia.post('/submit_Login', {
          username: this.username,
          password: this.password,
        }, {
          headers: {
            'X-CSRF-TOKEN': csrfToken, // Menambahkan CSRF token ke header
          }
        });
      } else {
        alert("Username and Password are required!");
      }
    },
  },
};
</script>

<style scoped>
/* General Body Styling */
body {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
}

.login {
  background-color: #001B2A;
  background-image: url('/images/Banner.PNG');
  background-size: cover; /* Ensures the image covers the entire background */
  background-position: center; /* Centers the image to make sure it's always aligned */
  background-repeat: no-repeat; /* Prevents the image from repeating */
  color: #fff;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  position: relative;
  height: 100vh; /* Ensures the full height is covered */
  width: 100%; /* Ensures the full width is covered */
}

/* Overlay Background */
.login::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
  z-index: 1;
}

.login * {
  position: relative;
  z-index: 2; /* Ensure content appears above the overlay */
}

/* Login Page Container */
.login-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  position: relative;
  z-index: 2; /* Ensure the login box is above the overlay */
}

/* Login Box Styling */
.login-box {
  background-color: #2b3134;
  padding: 2rem;
  border-radius: 15px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 100%;
  max-width: 400px;
  transition: transform 0.3s ease;
}

.login-box:hover {
  transform: translateY(-5px);
}

.login-title {
  margin-bottom: 1.5rem;
  color: #fff;
  font-size: 1.8rem;
  font-weight: 600;
}

/* Input Field Styling */
.input-container {
  margin: 0.8rem 0;
}

.input-field {
  width: 80%;
  padding: 0.8rem;
  border-radius: 30px;
  border: 1px solid #ddd;
  outline: none;
  font-size: 1rem;
  color: #333;
  background-color: #f9f9f9;
  transition: border-color 0.3s ease;
}

.input-field::placeholder {
  color: #aaa;
}

.input-field:focus {
  border-color: #5a9bff;
}

/* Submit Button Styling */
.btn-submit {
  width: 30%;
  padding: 0.9rem 0;
  border-radius: 15px;
  border: none;
  background-color: #ff6b4a;
  color: white;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-submit:hover {
  background-color: #ff4d34;
  transform: scale(1.05);
}

.btn-submit:active {
  background-color: #e04e34;
}

.success-message {
  color: #4caf50;
  background-color: #e8f5e9;
  padding: 1rem;
  border-radius: 5px;
  font-size: 0.9rem;
  margin-bottom: 1rem;
  text-align: center;
}

.flash-message {
  background-color: #ff6b4a;
  color: white;
  padding: 1rem;
  border-radius: 5px;
  margin-bottom: 1rem;
  text-align: center;
}

.flash-message.error {
  background-color: #e04e34;
}

</style>
