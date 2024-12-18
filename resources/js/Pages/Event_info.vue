<template>
  <div class="event-detail-page">
    <!-- Include Header -->
    <Header />

    <!-- Event Detail Section -->
    <section class="event-detail">
      <div class="event-detail-container">
        <div class="event-image-column">
          <img :src="`/${event.image}`" alt="Event Image" class="event-image" />
        </div>
        <div class="event-text-column">
          <h1>{{ event.deskripsi }}</h1>
          <p><strong></strong> {{ event.tanggal }}</p>
          <h4><strong></strong> {{ event.judul }}</h4>

        </div>
      </div>

      <div class="event-details">
        <h3>{{ event.judul_detail }}</h3>
        <p>{{ event.detail }}</p>
      </div>
    </section>

    <!-- Footer -->
    <Footer />
  </div>
</template>


<script>
import { Inertia } from '@inertiajs/inertia';
import Header from "./Header.vue";
import Footer from "./Footer.vue";

export default {
  name: "EventDetail",
  components: {
    Header,
    Footer,
  },
  props: {
    event: Object, // Event details passed from the backend
  },
};
</script>

<style scoped>
.event-detail-page {
  background-color: #001B2A;
  background-image: url('/images/background.PNG');
  background-size: cover;
  background-position: center;
  color: #fff;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  position: relative;
}

.event-detail-page::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  opacity: 0.7;
  mix-blend-mode: darken;
  z-index: 1;
}

.event-detail-page * {
  position: relative;
  z-index: 2;
}

.event-detail {
  padding: 50px;
}

.event-detail-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}

.event-image-column {
  flex: 1 1 40%; /* Image takes 40% of the width */
  padding-right: 20px;
}

.event-text-column {
  flex: 1 1 55%; /* Text takes 55% of the width */
  padding-left: 20px;
  padding-right: 70px;
}

.event-image {
  width: 100%;
  height: auto;
  object-fit: cover;
  border-radius: 8px;
}

.event-detail h1 {
  font-size:60px;
  color: #fff;
  margin-bottom: 10px;
}

.event-detail p {
  font-size: 18px;
  line-height: 1.5;
  margin-bottom: 15px;
}

.event-details h3 {
  font-size: 30px;
  color: #FF6B4A;
  margin-top: 20px;
}

.event-detail h4 {
  font-size: 24px;
  color: #FF6B4A;
  margin-top: 20px;
}

</style>
