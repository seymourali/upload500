import baseHttp from "../../api/baseHttp"
import * as mutypes from '../mutationTypes'

export default {

    state: {
        auth: {
            token: localStorage.getItem('token') || '',
            auth_user: {},
            user_grabbed: false
        }
    },

    getters: {
        isLoggedIn:      state => !!state.auth.token,
        authUserAccount: state => state.auth.auth_user,
        authUserGrabbed: state => state.auth.user_grabbed,
    },

    mutations: {
        [mutypes.AUTH_SUCCESS](state, token) {
            localStorage.setItem('token', token);
            state.auth.token = token;
        },
        [mutypes.AUTH_USER]:         (state, user) => state.auth.auth_user = user,
        [mutypes.AUTH_USER_GRABBED]: (state, value) => state.auth.user_grabbed = value,
        [mutypes.AUTH_CLEAR](state) {
            localStorage.removeItem('token');
            state.auth.token = '';
            state.auth.auth_user = '';
            console.log('### Auth cleared.');
        }
    },

    actions: {
        login: async ({commit, dispatch}, loginData) => {
            try {
              const resp = await baseHttp.post('/auth/login', loginData);
              commit(mutypes.AUTH_SUCCESS, resp.data.access_token);
              return true;

              //const account = await dispatch('grabAuthUser', {cache: 'clear'});
              //commit(mutypes.AUTH_USER_GRABBED, !!account);
              //return account;
            }
            catch (e) {
              console.log('###', e);
              throw(e)
            }
        },

        register: async({}, data) => {
            try {
                return await baseHttp.post('/auth/register', data);
            } catch (e) {
                console.log('###', e);
                throw(e);
            }
        },

        grabAuthUser: async({commit, getters}, params=null) => {
            try {
                commit(mutypes.AUTH_USER_GRABBED, false);

                const resp = await baseHttp.get('/auth/user', {params: params});
                commit(mutypes.AUTH_USER, resp.data.user);
                commit(mutypes.SET_ACCOUNT_USER_DATA, resp.data.user);
                commit(mutypes.AUTH_USER_GRABBED, true);
                return getters.authUserAccount;
            } catch(e) {
                console.log(e);
                throw(e);
            }
        },

        logout: async ({commit}) => {
            try {
                const resp = await baseHttp.post('/auth/logout');
                commit(mutypes.AUTH_CLEAR);
                return resp;
            } catch(e) {
                console.log(e);
                throw (e);
            }
        }
    }
}
