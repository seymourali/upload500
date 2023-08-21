import axios from 'axios';

const baseHttp = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    headers: {
        "Content-Type": "application/json"
    }
});

/**
 * Request Interceptors
 */
const getAuthToken = () => localStorage.getItem('token');
const authInterceptor = (config) => {
    const token = getAuthToken();
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`
    }
    return config;
}
baseHttp.interceptors.request.use(authInterceptor);

/**
 * Response Intrceptors
 */
const errorInterceptors = e => {
    switch (e.response.status) {
        case 401:
            console.log('###', e.response.status, e.message);
            localStorage.removeItem('token');
            break;
        default:
            console.log('### ', e.response.status, e.message, e.response)
    }
    return Promise.reject(e);
}

const responseInterceptor = r => {
    //
    return r
}

baseHttp.interceptors.response.use(responseInterceptor, errorInterceptors);

export default baseHttp;
