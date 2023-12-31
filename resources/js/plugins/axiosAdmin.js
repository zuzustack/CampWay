import axios from "axios";
import router from '../admin/routes'
import { getActivePinia } from "pinia"
import swal from './swal'

let BaseUrl = "";
if (window.location.hostname == "admin.localhost") {
  BaseUrl = "http://localhost:8000/api/";
} else {
  BaseUrl = "http://localhost:8000/api/";
}

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: BaseUrl

  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
});

axiosIns.interceptors.response.use(
  (response) => {
    return response;
  },
  (response) => {
    if (response.response.status === 401) {
      getActivePinia()._s.forEach(store => store.$reset());

      swal.close();
      localStorage.setItem("authToken", "")
      localStorage.setItem("userAbilities", "")
      localStorage.setItem("userData", "")

      router.push({name: 'login-auth'});
    } else {
      return Promise.reject(response);
    }
  }
);

export default axiosIns;