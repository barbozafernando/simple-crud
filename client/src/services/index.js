import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8080/api/v1"
});

api.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

export default api;