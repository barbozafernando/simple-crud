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
          {{ developer.data_nascimento }}
        </td>
        <td class="action-column">
          <button @click="handleShowDeveloper(developer.id)">Exibir</button>
          <button @click="handleUpdateDeveloper(developer.id)">Editar</button>
          <button @click="handleDeleteDeveloper(developer.id)">Excluir</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import mixin from "@/mixin";
import api from "@/services/developer";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: "Home",
  mixins: [mixin],
  components: {
    Loading
  },
  mounted() {
    this.isLoading = true;
    this.getAllDevelopers();
  },
  data() {
    return {
      developers: [],
      isLoading: false
    }
  },
  methods: {
    refreshPage() {
      return this.$router.go();
    },
    getAllDevelopers() {
      return api.getAll()
        .then((response) => {
          const { data } = response.data;
          return (this.developers = data);
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
</style>


