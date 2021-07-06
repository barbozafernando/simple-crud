<template>
  <div class="body">
    <h1>Desenvolvedor</h1>

    <loading 
      :active.sync="isLoading"
      :can-cancel="false"
      background-color="#2B5480"
      color="#fff"
      loader="spinner"
    />
  
    <div class="box">
      <div class="content">
        <p v-if="!isGoingToAddANewDeveloper && !isGoingToUpdateADeveloper">
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
            v-if="!isGoingToShowADeveloper"
          >
            {{ this.isGoingToUpdateADeveloper ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import mixin from "@/mixin";
import api from "@/services/developer";
import Loading from 'vue-loading-overlay';
import snakeCaseKeys from "snakecase-keys";
import camelCaseKeys from "camelcase-keys";
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  name: "Developer",
  mixins: [mixin],
  components: {
    Loading
  },
  mounted() {
    if (this.isGoingToAddANewDeveloper) return;

    this.isLoading = true;
    const developerId = this.getRouteParams();

    api.getById(developerId)
      .then((response) => {
        return (this.developer = camelCaseKeys(response.data));
      })
      .catch(({ response }) => {
        return this.showAlert(response.data.error.message);
      })
      .finally(() => (this.isLoading = false));
  },
  data() {
    return {
      developer: {},
      isLoading: false
    }
  },
  computed: {
    isGoingToAddANewDeveloper() {
      return this.$route.name === 'developer-new';
    },
    isGoingToUpdateADeveloper() {
      return this.$route.name === 'developer-edit';
    },
    isGoingToShowADeveloper() {
      return this.$route.name === 'developer-show';
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
    handleSubmit(event) {
      event.preventDefault();

      const data = {
        nome: this.developer.nome,
        idade: Number(this.developer.idade),
        sexo: this.developer.sexo,
        hobby: this.developer.hobby,
        dataNascimento: this.developer.dataNascimento
      }

      const developerId = this.getRouteParams();

      const saveOrUpdate = developerId ? api.update : api.create;

      this.isLoading = true;
      return saveOrUpdate(snakeCaseKeys(data), developerId)
        .then(response => {
          if (response.status === 200) {
            this.showAlert("Developer updated successfully!");
            return this.$router.push({ name: "Home" });
          }

          if (response.status === 201) {
            this.showAlert("Developer added successfully!");
            return this.$router.push({ name: "Home" });
          }
        })
        .catch(({ response }) => {
          if (response.status >= 400 && response.status <= 499) {
            return this.showAlert(response.data.error.message);
          }
        })
        .finally(() => (this.isLoading = false));
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