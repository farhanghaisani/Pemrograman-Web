import axios from "axios";

const Api = axios.create({
  // Gunakan URL baru server Anda
  baseURL: "http://127.0.0.1:8000",
});

export default Api;
