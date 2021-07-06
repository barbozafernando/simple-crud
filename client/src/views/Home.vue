<template>
  <div id="body">
    <h1>Lista de desenvolvedores</h1>

    <loading 
      :active.sync="isLoading"
      :can-cancel="false"
      background-color="#2B5480"
      color="#fff"
      loader="spinner"
    />

    <button style="margin-bottom: 15px;" @click="handleAddNewDeveloper">
      Novo Desenvolvedor
    </button>

    <table border="1">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Sexo</th>
        <th>Hobby</th>
        <th>Data de nascimento</th>
        <th>Ações</th>
      </tr>
      
      <tr v-for="developer in developers" :key="developer.id">
        <td>
          {{ developer.id }}
        </td>
        <td>
          {{ developer.nome }}
        </td>
        <td>
          {{ developer.idade }}
        </td>
        <td>
          {{ developer.sexo }}
        </td>
        <td>
          {{ developer.hobby }}
        </td>
        <td>
          {{ convertDateIntoPtBr(developer.data_nascimento) }}
        </td>
        <td class="action-column">
          <button @click="handleShowDeveloper(developer.id)">Exibir</button>
          <button @click="handleUpdateDeveloper(developer.id)">Editar</button>
          <button @click="handleDeleteDeveloper(developer.id)">Excluir</button>
        </td>
      </tr>
    </table>

    <Paginate
      :page-count="pagination.totalPages"
      :click-handler="pageChangeHandler"
      :prev-text="'Anterior'"
      :next-text="'Próximo'"
      :container-class="'pagination'"
      :page-class="'page-item'"
      :margin-pages="3"
      :page-link-class="'buttons'"
      :prev-link-class="'buttons'"
      :next-link-class="'buttons'"
      :prev-class="'next-prev-buttons'"
      :next-class="'next-prev-buttons'"
      :active-class="'active-button'"
    >
    </Paginate>
  </div>
</template>

<script>
import mixin from "@/mixin";
import Paginate from 'vuejs-paginate';
import api from "@/services/developer";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: "Home",
  mixins: [mixin],
  components: {
    Loading,
    Paginate
  },
  mounted() {
    this.isLoading = true;
    this.getAllDevelopers({
      page: 1,
      rowsPerPage: 5
    });
  },
  data() {
    return {
      developers: [],
      isLoading: false,
      pagination: {
        currentPage: 1,
        totalPages: 1
      }
    }
  },
  methods: {
    refreshPage() {
      return this.$router.go();
    },
    convertDateIntoPtBr(date) {
      const dateSplitted = date.split("-");
      return `${dateSplitted[2]}/${dateSplitted[1]}/${dateSplitted[0]}`;
    },
    getAllDevelopers(pagination) {
      this.isLoading = true;

      return api.getAll(pagination)
        .then((response) => {
          const { data } = response;

          this.pagination.currentPage = data.current_page;
          this.pagination.totalPages = data.last_page;

          return (this.developers = data.data);
        })
        .catch(({ response }) => {
          return this.showAlert(response.data.error.message);
        })
        .finally(() => (this.isLoading = false));
    },
    handleShowDeveloper(developerId) {
      return this.$router.push({ name: 'developer-show', params: { developerId } });
    },
    handleAddNewDeveloper() {
      return this.$router.push({ name: 'developer-new' });
    },
    handleUpdateDeveloper(developerId) {
      return this.$router.push({ name: 'developer-edit', params: { developerId } });
    },
    handleDeleteDeveloper(developerId) {
      const isGoingToDeleteDeveloper = confirm(
        "Do you really want to delete this developer?"
      );

      if (!isGoingToDeleteDeveloper) return;

      this.isLoading = true;

      return api.remove(developerId)
        .then(response => {       
          if (response.status === 204) {
            this.showAlert("Developer removed successfully!");
            return this.refreshPage();
          }
        })
        .catch(({ response }) => {
          if (response.status === 400) {
            this.showAlert(response.data.error.message);
            return this.refreshPage();
          }
        })
        .finally(() => (this.isLoading = false));
    },
    pageChangeHandler(page) {
      this.pagination.currentPage = page;

      this.getAllDevelopers({
        page
      });
    }
  }
}
</script>

<style>
  body {
    text-align: center;
  }
  table {
    margin: auto;
  }
  button a {
    text-decoration: none;
    color: #000;
  }
  .action-column > * {
    margin: 0 5px
  }
  .pagination {
    display: flex;
    justify-content: center;
    list-style-type: none;
    margin-top: 30px;
  }
  .page-item {
    padding: 2px 10px;
    border: 2px solid #f0f0f0;
    display: flex;
    color: #3667e3;
    align-items: center;
  }
  .buttons {
    padding: 8px;
    font-weight: bold;
    border-radius: 5px;
    list-style-type: none;
  }
  .next-prev-buttons {
    display: flex;
    color: #3667e3;
    align-items: center;
    padding: 2px 10px;
    border: 2px solid #f0f0f0;
  }
  .active-button {
    color: white;
    background-color: #3667e3;
  }
</style>