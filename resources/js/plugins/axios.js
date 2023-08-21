import axios from "axios";
import router from '../routes'
import { getActivePinia } from "pinia"


const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: "http://localhost:8000/api/"

  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
});

axiosIns.interceptors.response.use(
  (response) => {
    return response;
  },
  (response) => {
    if (response.response.status === 401) {
      console.log("Masukk");
      getActivePinia()._s.forEach(store => store.$reset());

      localStorage.setItem("accessToken", "")
      localStorage.setItem("userAbilities", "")
      localStorage.setItem("userData", "")

      router.push({name: 'login'});
    } else {
      return Promise.reject(response);
    }
  }
);

export default axiosIns;