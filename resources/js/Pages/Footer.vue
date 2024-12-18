<template>

  <footer>
    <div class="footer-content">
      <div class="footer-logo">
        <h3>terseear<span>art</span></h3>
      </div>
      <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Contact Us</a>
        <a href="#">About Us</a>
      </div>
      <p>Hak cipta © Terseeart Studio</p>
      <p>terseearoriginal@gmail.com</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style scoped>

footer {
  background: #2b3134;
  padding: 40px 0;
  color: #fff;
  text-align: center;
}

.footer-content {
  max-width: 1200px;
  margin: 0 auto;
}

.footer-logo h3 {
  font-size: 24px;
  font-weight: bold;
}

.footer-logo span {
  color: orange;
}

.footer-links {
  margin: 20px 0;
}

.footer-links a {
  margin: 0 15px;
  color: #fff;
  text-decoration: none;
}

.footer-links a:hover {
  text-decoration: underline;
}

footer p {
  font-size: 14px;
  color: #ddd;
}
</style>
