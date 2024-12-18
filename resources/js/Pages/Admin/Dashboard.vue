<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="rows"
      :pagination="pagination"
      :search-options="searchOptions"
    />
  </div>
</template>

<script>
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";

export default {
  name: "DataTableComponent",
  components: {
    VueGoodTable
  },
  data() {
    return {
      // Define the columns of the table
      columns: [
        {
          label: "ID",
          field: "id",
          type: "number"
        },
        {
          label: "Name",
          field: "name",
          type: "text"
        },
        {
          label: "Age",
          field: "age",
          type: "number"
        },
        {
          label: "Country",
          field: "country",
          type: "text"
        }
      ],
      // Example rows data
      rows: [
        { id: 1, name: "John Doe", age: 30, country: "USA" },
        { id: 2, name: "Jane Smith", age: 25, country: "Canada" },
        { id: 3, name: "Carlos Ruiz", age: 35, country: "Mexico" },
        { id: 4, name: "Maria Garcia", age: 40, country: "Spain" }
      ],
      // Pagination configuration
      pagination: {
        enabled: true,
        perPage: 5
      },
      // Search options
      searchOptions: {
        enabled: true,
        placeholder: "Search..."
      }
    };
  }
};
</script>

<style scoped>
/* Custom styles if necessary */
</style>
