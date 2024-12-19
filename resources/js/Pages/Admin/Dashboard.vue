<template>
  <div>
    <!-- Navbar without collapse behavior -->
    <nav class="navbar navbar-expand-lg custom-navbar">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Navbar</a>

        <div class="navbar-nav mx-auto">
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/event">Event</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>

        <!-- User Profile Section -->
        <div class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-white"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              {{ userName }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item" href="#" @click="logout">Logout</a></li>
            </ul>
          </li>
        </div>
      </div>
    </nav>



    <!-- Add Data Modal -->

  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  name: "NavbarWithTable",
  data() {
    return {
      userName: "John Doe", // Replace with actual user data
      searchQuery: "",
      currentPage: 1,
      perPage: 5,
      totalPages: 0,
      showModal: false,
      newEvent: {
        judul: "",
        deskripsi: "",
        tanggal: "",
        image: null,
        judul_detail: "",
        detail: ""
      }
    };
  },
  props: {
    data: Array,
  },
  computed: {
    filteredData() {
      if (this.searchQuery) {
        return this.data.filter(item =>
          item.judul.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          item.deskripsi.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
      return this.data;
    },
    paginatedData() {
      const start = (this.currentPage - 1) * this.perPage;
      return this.filteredData.slice(start, start + this.perPage);
    }
  },
  methods: {
    logout() {
      // Logic to handle logout (e.g., clear session, redirect)
      alert("Logged out");
    },
    searchData() {
      // Triggered when user types in the search box
      this.currentPage = 1; // Reset to the first page on search
    },
    changePage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    handleFileChange(event) {
      // Handle file input change
      const file = event.target.files[0];
      if (file) {
        this.newEvent.image = file; // Store file object in the event data
      }
    },
     submitData() {
      // Prepare form data to include image
      const formData = new FormData();
      formData.append('judul', this.newEvent.judul);
      formData.append('deskripsi', this.newEvent.deskripsi);
      formData.append('tanggal', this.newEvent.tanggal);
      formData.append('image', this.newEvent.image); // Append the image file
      formData.append('judul_detail', this.newEvent.judul_detail);
      formData.append('detail', this.newEvent.detail);

      // Send form data to Laravel backend via Inertia
      Inertia.post('/simpan_event', formData)
        .then(() => {
          // Close modal after success
          this.closeModal();
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  watch: {
    filteredData(newData) {
      this.totalPages = Math.ceil(newData.length / this.perPage);
    }
  }
};
</script>

<style scoped>
/* Custom Navbar Colors */
.custom-navbar {
  background-color: #001B2A;
}

/* Text color for navbar */
.navbar-brand,
.nav-link {
  color: #ffffff !important;
}

/* User profile dropdown styles */
.navbar-nav .dropdown-menu {
  right: 0;
}

/* Profile picture in the navbar */
.navbar-nav .dropdown img {
  border-radius: 50%;
}
</style>
