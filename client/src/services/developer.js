import axios from "@/services";

const getAll = ({ page, rowsPerPage = 5 }) => 
    axios.get(`/developers?rows=${rowsPerPage}&page=${page}`);

const getById = developerId => axios.get(`/developers/${developerId}`);

const create = developer => axios.post("/developers", developer);

const update = (developer, developerId) => axios.put(`/developers/${developerId}`, developer);

const remove = developerId => axios.delete(`/developers/${developerId}`);

export default {
    getAll,
    getById,
    create,
    update,
    remove
}