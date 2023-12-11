
import { createStore } from "vuex";

const store = createStore({
    state: {
        loader: false,
        user: null,
    },
    getters: {
        getUser: (state) => {
            const user = localStorage.getItem('user')
            if(state.user != null) return state.user

            if(user && JSON.parse(user)) return JSON.parse(user)

            return null
        },
        getRole: (state) => {
            const role = localStorage.getItem('role')
            if(state.user != null) return state.role

            if(role) return (role)

            return null
        }

    },
    mutations: {
        setUser: (state, payload) => {
            state.user = payload
        },
    },
    actions: {
        
    }
});

export default store