<template>
  <div class="landing-page">
    <!-- Include Header -->
    <Header />

    <!-- Event Table -->
    <section class="tabel">
      <div class="container mt-4 mb-3">
        <button class="btn btn-success" @click="openModal">Tambah Data</button>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Image</th>
            <th>Judul Detail</th>
            <th>Detail</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(event, index) in events.data" :key="event.id">
            <td>{{ events.from + index }}</td>
            <td>{{ event.judul }}</td>
            <td>{{ event.deskripsi }}</td>
            <td>{{ event.tanggal }}</td>
            <td>
              <img :src="'/storage/' + event.image" alt="Event Image" width="100" height="100" />
            </td>
            <td>{{ event.judul_detail }}</td>
            <td>{{ event.detail }}</td>
            <td>
              <button class="btn btn-warning" @click="openEditModal(event)">Edit</button>
              <button class="btn btn-danger" @click="deleteEvent(event.id)">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
       <div class="pagination">
        <template v-for="link in events.links">
          <Link
            v-if="link.url"
            :key="link.label"
            :href="link.url"
            :class="['page-btn', { active: link.active }]"
            preserve-scroll
            v-html="link.label"
          />
          <span
            v-else
            :key="link.label"
            class="page-btn disabled"
            v-html="link.label"
          />
        </template>
      </div>
    </section>

    <!-- Pagination -->
   

    <!-- Footer -->
    <Footer />

    <!-- Add Data Modal -->
    <div v-if="showModal" class="modal" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="btn-close" @click="closeModal"></button>
      </div>
      <div class="modal-body">
            <form @submit.prevent="submitData"  enctype="multipart/form-data">
              <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input v-model="newEvent.judul" type="text" class="form-control" id="judul" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea v-model="newEvent.deskripsi" class="form-control" id="deskripsi" required></textarea>
              </div>
              <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input v-model="newEvent.tanggal" type="text" class="form-control" id="tanggal" required>
              </div>
             <div class="mb-3">
                <label for="photo" class="form-label">Select Photo</label>
                <input type="file" id="image" ref="image" class="form-control" @change="handleFileChange" required />
              </div>
              <div class="mb-3">
                <label for="judul_detail" class="form-label">Judul Detail</label>
                <input v-model="newEvent.judul_detail" type="text" class="form-control" id="judul_detail" required>
              </div>
              <div class="mb-3">
                <label for="detail" class="form-label">Detail</label>
                <textarea v-model="newEvent.detail" class="form-control" id="detail" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>



<div v-if="showEditModal" class="modal" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="btn-close" @click="closeEditModal"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="updateEvent"  enctype="multipart/form-data">
            <div class="mb-3">
              <label for="editJudul" class="form-label">Judul</label>
              <input v-model="editEvent.judul" type="text" class="form-control" id="judul" required />
            </div>
            <div class="mb-3">
              <label for="editDeskripsi" class="form-label">Deskripsi</label>
              <textarea v-model="editEvent.deskripsi" class="form-control" id="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
              <label for="editTanggal" class="form-label">Tanggal</label>
              <input v-model="editEvent.tanggal" type="text" class="form-control" id="tanggal" required />
            </div>
            <div class="mb-3">
              <label for="editPhoto" class="form-label">Select Photo</label>
              <input type="file" id="image" ref="image" class="form-control" @change="handleEditFileChange" />
            </div>
            <div class="mb-3">
              <label for="editJudulDetail" class="form-label">Judul Detail</label>
              <input v-model="editEvent.judul_detail" type="text" class="form-control" id="judul_detail" required />
            </div>
            <div class="mb-3">
              <label for="editDetail" class="form-label">Detail</label>
              <textarea v-model="editEvent.detail" class="form-control" id="detail" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
</div>

  </div>
</template>



<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/vue3';
import Header from './Header.vue';
import Footer from './Footer.vue';

const props = defineProps({
  events: {
    type: Object,
    required: true,
  },
});

const showModal = ref(false);
const showEditModal = ref(false);

const newEvent = ref({
  judul: '',
  deskripsi: '',
  tanggal: '',
  image: null,
  judul_detail: '',
  detail: ''
});

const editEvent = ref({
  id: null,
  judul: '',
  deskripsi: '',
  tanggal: '',
  image: null,
  judul_detail: '',
  detail: ''
});

const form = useForm({
  judul: '',
  deskripsi: '',
  tanggal: '',
  image: null,
  judul_detail: '',
  detail: '',
});

const editForm = useForm({
  id: null,
  judul: '',
  deskripsi: '',
  tanggal: '',
  image: null,
  judul_detail: '',
  detail: '',
});

const openModal = () => {
  showModal.value = true;
  // Reset newEvent for a fresh form
  newEvent.value = {
    judul: '',
    deskripsi: '',
    tanggal: '',
    image: null,
    judul_detail: '',
    detail: ''
  };
};

const closeModal = () => {
  showModal.value = false;
  form.reset();
};

const submitData = () => {
  const formData = new FormData();
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  formData.append('judul', newEvent.value.judul);
  formData.append('deskripsi', newEvent.value.deskripsi);
  formData.append('tanggal', newEvent.value.tanggal);
  formData.append('image', newEvent.value.image);
  formData.append('judul_detail', newEvent.value.judul_detail);
  formData.append('detail', newEvent.value.detail);

  fetch(route('events.store'), {
    method: 'POST',
    body: formData,
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Data added successfully');
      // Optionally, you can reload or close the modal
      window.location.reload(); 
    } else {
      alert('Failed to add data: ' + data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred. Please try again.');
  });
};


const openEditModal = (event) => {
  editEvent.value = { ...event }; // Assign values to editEvent
  showEditModal.value = true;
};

const closeEditModal = () => {
  showEditModal.value = false;
  editForm.reset();
};

const updateEvent = () => {
  const formData = new FormData();
  formData.append('_method', 'PUT');
  formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Pastikan token CSRF disertakan
  formData.append('judul', editEvent.value.judul);
  formData.append('deskripsi', editEvent.value.deskripsi);
  formData.append('tanggal', editEvent.value.tanggal);
  formData.append('image', editEvent.value.image);
  formData.append('judul_detail', editEvent.value.judul_detail);
  formData.append('detail', editEvent.value.detail);

  fetch(route('events.update', { event: editEvent.value.id }), {
    method: 'POST', // Menggunakan POST karena Anda sudah menambahkan _method
    body: formData,
    headers: {
      'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Accept': 'application/json',
    },
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Data updated successfully');
      window.location.reload(); 
    }
  })
  .catch(error => console.error('Error:', error));
};




const handleFileChange = (event) => {
  const file = event.target.files[0];
  newEvent.value.image = file; 
};

const handleEditFileChange = (event) => {
  editEvent.value.image = event.target.files[0];
};


const deleteEvent = (id) => {
  if (confirm('Are you sure you want to delete this event?')) {
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Sending a DELETE request using fetch
    fetch(route('events.destroy', id), {
      method: 'DELETE',
      headers: {
        'X-XSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        _token: csrfToken, // Add CSRF token in the request body
      }),
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Event deleted successfully!');
        // Optionally, you can reload or remove the event from the list
        window.location.reload(); // or dynamically remove the deleted event from the list
      } else {
        alert('Failed to delete the event');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred. Please try again.');
    });
  }
};
</script>



<style scoped>
/* Your styles here */
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
</style>
