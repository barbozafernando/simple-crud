<template>
  <div id="body">
    <h1>Lista de desenvolvedores</h1>

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
          <button >Excluir</button>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import api from "@/services/developer";

export default {
  name: "Home",
  async mounted() {
    await this.getAllDevelopers();
  },
  data() {
    return {
      developers: []
    }
  },
  methods: {
    async getAllDevelopers() {
      const { data: response } = await api.getAll();

      this.developers = response.data;
    },
    handleShowDeveloper(developerId) {
      return this.$router.push({ name: 'developer-show', params: { developerId } });
    },
    handleAddNewDeveloper() {
      return this.$router.push({ name: 'developer-new' });
    },
    handleUpdateDeveloper(developerId) {
      return this.$router.push({ name: 'developer-edit', params: { developerId } });
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


