<template>
  <div class="body">
    <h1>Desenvolvedor</h1>
  
    <div class="box">
      <div class="content">
        <p>
          <label for="id">ID:</label> </br>

          <input type="text" v-model="this.developer.id" />
        </p>

        <p>
          <label for="nome">Nome:</label> </br>

          <input type="text" v-model="this.developer.nome" />
        </p>

        <p>
          <label for="idade">Idade:</label></br>

          <input type="text" v-model="this.developer.idade" />
        </p>

        <p>
          <label for="sexo">Sexo:</label></br>
          
          <select name="sexo" v-model="this.developer.sexo">
            <option value="M" >Masculino</option>
            <option value="F">Feminino</option>
          </select>
        </p>

        <p>
          <label for="hobby">Hobby:</label></br>

          <textarea 
            name="hobby" 
            v-model="this.developer.hobby" 
            rows="5"
          />
        </p>

        <p>
          <label for="data_nascimento">Data de nascimento:</label></br>

          <input 
            type="date" 
            name="data_nascimento" 
            v-model="this.developer.data_nascimento"
          />
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
    goToPreviousRoute() {
      return this.$router.go(-1);
    }
  }
}
</script>

<style scoped>
  .body {
    text-align: center;
    font-weight: bold;
  }
  .box {
    background-color: lightgrey;
    width: 80rem;
    height: 33rem;
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
  textarea {
    resize: none;
  }
</style>