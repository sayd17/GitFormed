import axios from "axios";
import { useStateContext } from "./contexts/ContextProvider.jsx";
import { cors } from "cors";
import { Navigate } from "react-router-dom";
// var cors = require("cors");
// app.use(cors()); // Use this after the variable declaration

const axiosClient = axios.create({
  baseURL: `http://127.0.0.1:8000/api`,
  // baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`,
});

axiosClient.interceptors.request.use((config) => {
  //   const token = localStorage.getItem("ACCESS_TOKEN");
  //   config.headers.Authorization = `Bearer ${token}`;
  return config;
});

axiosClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    const { response } = error;
    if (response.status === 401) {
      localStorage.removeItem("ACCESS_TOKEN");
      // window.location.reload();
    } else if (response.status === 404) {
      //Show not found
    }

    throw error;
  }
);

export default axiosClient;
