import axios from "@/services";

const getAll = () => axios.get("/developers");

export default {
    getAll
}