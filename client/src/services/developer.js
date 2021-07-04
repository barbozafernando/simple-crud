import axios from "@/services";

const getAll = () => axios.get("/developers");

const getById = developerId => axios.get(`/developers/${developerId}`)

export default {
    getAll,
    getById
}