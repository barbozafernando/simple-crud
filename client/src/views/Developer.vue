<template>
  <div class="body">
    <h1>Desenvolvedor</h1>
  
    <div class="box">
      <div class="content">
        <p v-if="!isGoingToAddANewDeveloper">
          <label for="id">ID:</label> </br>

          <input 
            type="text" 
            v-model="developer.id" 
            :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper"
          />
        </p>

        <p>
          <label for="nome">Nome:</label> </br>

          <input 
            type="text" 
            v-model="developer.nome" 
            :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper" 
          />
        </p>

        <p>
          <label for="idade">Idade:</label></br>

          <input 
            type="number" 
            v-model="developer.idade" 
            :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper"
          />
        </p>

        <p>
          <label for="sexo">Sexo:</label></br>
          
          <select name="sexo" v-model="developer.sexo" :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper">
            <option value="M" >Masculino</option>
            <option value="F">Feminino</option>
          </select>
        </p>

        <p>
          <label for="hobby">Hobby:</label></br>

          <textarea 
            name="hobby" 
            v-model="developer.hobby" 
            rows="5"
            :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper"
          />
        </p>

        <p>
          <label for="dataNascimento">Data de nascimento:</label></br>

          <input 
            type="date" 
            name="dataNascimento" 
            v-model="developer.dataNascimento"
            :disabled="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper"
          />
        </p>

        <div>
          <button 
            style="margin-top: 30px" 
            @click="goToPreviousRoute"
          >
            Voltar
          </button>

          <button 
            style="margin-top: 30px" 
            @click="handleSubmit"
          >
            {{ this.isGoingToUpdateADeveloper ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "@/services/developer";
import snakeCaseKeys from "snakecase-keys";
import camelCaseKeys from "camelcase-keys";

export default {
  name: "Developer",
  async mounted() {
    if (this.isGoingToAddANewDeveloper) return;

    const developerId = this.getRouteParams();
    const { data: response } = await api.getById(developerId);

    this.developer = camelCaseKeys(response);
  },
  data() {
    return {
      developer: {}
    }
  },
  computed: {
    isGoingToAddANewDeveloper() {
      return !this.getRouteParams();
    },
    isGoingToUpdateADeveloper() {
      return this.$route.name === 'developer-edit';
    },
  },
  methods: {
    goToPreviousRoute() {
      return this.$router.go(-1);
    },
    getRouteParams() {
      const { developerId } = this.$route.params;
      return developerId;
    },
    showAlert(msg) {
      return alert(msg);
    },
    async handleSubmit(event) {
      event.preventDefault();

      const data = {
        nome: this.developer.nome,
        idade: Number(this.developer.idade),
        sexo: this.developer.sexo,
        hobby: this.developer.hobby,
        dataNascimento: this.developer.dataNascimento
      }

      const response = await api.create(snakeCaseKeys(data));

      if (response.status === 201) {
        this.showAlert("Developer added successfully!");
        return this.$router.push({ name: "Home" })
      }

      return this.showAlert(response.error.msg);
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