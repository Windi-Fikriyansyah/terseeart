<template>
  <nav>
    <ul class="pagination">
      <li
        v-if="currentPage > 1"
        class="page-item"
        @click="changePage(currentPage - 1)"
      >
        <a class="page-link" href="#">Previous</a>
      </li>

      <li
        v-for="page in pages"
        :key="page"
        class="page-item"
        :class="{ active: page === currentPage }"
        @click="changePage(page)"
      >
        <a class="page-link" href="#">{{ page }}</a>
      </li>

      <li
        v-if="currentPage < lastPage"
        class="page-item"
        @click="changePage(currentPage + 1)"
      >
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    currentPage: Number,
    lastPage: Number,
    total: Number,
  },
  computed: {
    pages() {
      let pages = [];
      for (let i = 1; i <= this.lastPage; i++) {
        pages.push(i);
      }
      return pages;
    },
  },
  methods: {
    changePage(page) {
      this.$emit("page-changed", page);
    },
  },
};
</script>
