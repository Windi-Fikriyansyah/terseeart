<template>
  <div class="landing-page">
    <!-- Include Header -->
    <Header />

    <!-- Upcoming Events -->
    <section class="upcoming-events">
      <h2>UPCOMING EVENT</h2>
      <div class="events-grid">
        <div class="event-card" v-for="event in paginatedEvents" :key="event.id" @click="goToEventPage(event.id)">
          <h3>{{ event.judul }}</h3>
          <img :src="event.image" alt="Event Image" />
          <h4>{{ event.deskripsi }}</h4>
          <p>{{ event.tanggal }}</p>
        </div>
      </div>

      <div class="pagination">
        <button
          @click="prevPage"
          :disabled="currentPage === 1"
          class="page-btn"
        >
          &lt;
        </button>

        <div class="page-numbers">
          <button
            v-for="pageNumber in totalPages"
            :key="pageNumber"
            @click="goToPage(pageNumber)"
            :class="{
              'page-btn': true,
              'active': currentPage === pageNumber
            }"
          >
            {{ pageNumber }}
          </button>
        </div>

        <button
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="page-btn"
        >
          &gt;
        </button>
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
  name: "LandingPage",
  components: {
    Header,
    Footer,
  },
  props: {
    events: {
      type: Array,
      default: () => []
    },
  },
  data() {
    return {
      currentPage: 1,
      eventsPerPage: 6 // Adjust based on your grid layout
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.events.length / this.eventsPerPage);
    },
    paginatedEvents() {
      const start = (this.currentPage - 1) * this.eventsPerPage;
      const end = start + this.eventsPerPage;
      return this.events.slice(start, end);
    }
  },
  methods: {
    goToEventPage(eventId) {
      Inertia.visit(`/event/${eventId}`);
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    goToPage(pageNumber) {
      this.currentPage = pageNumber;
    }
  },

};
</script>

<style scoped>

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 30px;
  gap: 10px;
}

.page-btn {
  background-color: #2B3134;
  color: #fff1cc;
  border: none;
  padding: 8px 12px;
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.page-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.page-btn.active {
  background-color: #FF6B4A;
  color: #001B2A;
}

.page-btn:hover:not(:disabled) {
  background-color: #FF6B4A;
  color: #001B2A;
}

.page-numbers {
  display: flex;
  gap: 10px;
}


.landing-page {
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

.landing-page::before {
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

.landing-page * {
  position: relative;
  z-index: 2;
}

.upcoming-events, .find-community {
  padding: 50px 20px;
  text-align: left;
}

.upcoming-events h2, .find-community h2 {
  color: #FF6B4A; /* Warna teks */
  font-size: 50px; /* Ukuran huruf */
  margin-bottom: 25px; /* Spasi bawah */
  font-family: "Coolvetica", sans-serif; /* Font dengan fallback */
  font-weight: 400; /* Berat font */
  text-align: center; /* Menambahkan opsi untuk perataan tengah (opsional) */
  line-height: 1.2;
}


.upcoming-events h3 {
  color: #FF6B4A;
  font-size: 15px;
  font-weight : 400;
}

.events-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Membagi grid menjadi 2 kolom */
  gap: 20px; /* Jarak antar elemen */
  justify-content: center;
}

.event-card {
  background: #2B3134;
  padding: 20px;
  border-radius: 10px;
  cursor: pointer;
}

.event-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}

.footer-contact {
  background: #ff6b4a;
  padding: 20px 10px;
  text-align: center;
  color: #000;
  font-weight: bold;
}

.upcoming-events p {
  color: #FF6B4A;
  font-size: 10px;
  font-weight : 400;
}
</style>
