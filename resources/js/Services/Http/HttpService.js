import axios from "axios";

axios.defaults.baseURL = "http://localhost:8000/";

if (window.localStorage.getItem("access_token")) {
    var config = {
        headers: {
            Authorization: "Bearer " + window.localStorage.getItem("access_token")
        }
    };
} else {
    var config = {};
}

class HttpService {
    static get(url, params) {
        if (!params) {
            return axios.get(url);
        } else {
            return axios.get(url, params);
        }
    }
    static post(url, params) {
        return axios.post(url, params);
    }
    static user_post(url, params) {
        return axios.post(url, params, config);
    }
}

export default HttpService;