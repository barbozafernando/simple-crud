<template>
  <div>
    <h1>Exibir Produto</h1>
  
    <div class="box">
      <div class="content">
        <p>
          ID: <strong>{{ this.developer.id }}</strong>
        </p>

        <p>
          Nome: <strong>{{ this.developer.nome }}</strong>
        </p>

        <p>
          Idade: <strong>{{ this.developer.idade }}</strong>
        </p>

        <p>
          Sexo: <strong>{{ formatSexo(this.developer.sexo) }}</strong>
        </p>

        <p>
          Hobby: <strong>{{ this.developer.hobby }}</strong>
        </p>

        <p>
          Data de nascimento: <strong>{{ this.developer.data_nascimento }}</strong>
        </p>

        <button 
          style="margin-top: 30px" 
          @click="goToPreviousRoute"
        >
          Voltar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/services/developer";

export default {
  name: "Developer",
  async mounted() {
    const { developerId } = this.$route.params;

    const { data: response } = await api.getById(developerId);

    this.developer = response;
  },
  data() {
    return {
      developer: {}
    }
  },
  methods: {
    formatSexo(sexo) {
      return sexo === "M" ? "Masculino" : "Feminino";
    },
    goToPreviousRoute() {
      return this.$router.go(-1);
    }
  }
}
</script>

<style scoped>
  body {
    text-align: center;
    font-size: 20px;
  }
  .box {
    background-color: lightgrey;
    width: 80rem;
    height: 350px;
    margin: auto;
    border-radius: 5px;
  }
  .content {
    padding: 20px;
  }
  a {
    text-decoration: none;
    color: black;
  }
  button {
    font-size: 18px;
  }
</style>