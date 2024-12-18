<template>
<Header />
  <div class="login">
    <div class="login-wrapper">
      <div class="login-box">
        <h2 class="login-title">Sign Up</h2>


        <!-- Username Input -->
        <div class="input-container">
          <input
            v-model="username"
            type="text"
            placeholder="Username"
            class="input-field"
          />
          <!-- Display Error -->
          <span v-if="$page.props.errors.username" class="error-text">
            {{ $page.props.errors.username }}
          </span>
        </div>

        <!-- Password Input -->
        <div class="input-container">
          <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="input-field"
          />
          <!-- Display Error -->
          <span v-if="$page.props.errors.password" class="error-text">
            {{ $page.props.errors.password }}
          </span>
        </div>

        <!-- Confirm Password Input -->
        <div class="input-container">
          <input
            v-model="password_confirmation"
            type="password"
            placeholder="Confirm Password"
            class="input-field"
          />
          <!-- Display Error -->
          <span v-if="$page.props.errors.password_confirmation" class="error-text">
            {{ $page.props.errors.password_confirmation }}
          </span>
        </div>

        <!-- Submit Button -->
        <button class="btn-submit" @click="register">Create Account</button>
      </div>
    </div>
  </div>
   <Footer />
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";

export default {
components: {
    Header,
    Footer,
  },
  data() {
    return {
      username: '',
      password: '',
      password_confirmation: '',
    };
  },
  methods: {
    register() {
      this.$inertia.post('/submit_register', {
        username: this.username,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
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
  width: 50%;
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
</style>
