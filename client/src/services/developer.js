import axios from "@/services";

const getAll = () => axios.get("/developers");

const getById = developerId => axios.get(`/developers/${developerId}`);

const create = developer => axios.post("/developers", developer);

export default {
    getAll,
    getById,
    create
}