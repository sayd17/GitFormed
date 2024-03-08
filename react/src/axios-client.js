import axios from "axios";

const axiosClient = axios.create({
  baseURL: `{$import.meta.env.VITE_API_BASE_URL}/Api`,
});

axiosClient.interceptors.request.use((config) => {
  // debugger;
  const token = localStorage.getItem("ACCESS_TOKEN");
  config.headers.Authorization = `Bearer ${token}`;
  return config;
});

axiosClient.interceptors.response.use(
  (response) => {
    // Do something before response is sent
    return response;
  },
  (error) => {
    try {
      const { response } = error;
      if (response.status == 401) {
        localStorage.removeItem("ACCESS_TOKEN");
      }
    } catch (error) {
      console.log(error);
    }

    throw error;
    // return Promise.reject(error);
  }
);

export default axiosClient;
