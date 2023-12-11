<template>
    <div class="admin-login-wrapper">
        <div class="admin-form-wrapper">
            <h3>Panel de Administración SCOM</h3>
            <form>
                <div class="form-group">
                    <label for="">Nombre de cuenta</label>
                    <input type="text" v-model="creds.nombre_cuenta" class="form-control" autocomplete="username"
                        placeholder="nombre de cuenta" />
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" v-model="creds.password" class="form-control" placeholder="**********"
                        autocomplete="current-password" />
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-main btn-block" @click="signin">Ingresar</button>
                </div>
            </form>
            <div class="form-group form-link">
                <router-link to="/">Volver a Inicio</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import router from '../../router/router'
import { useToast } from "vue-toastification"

export default {
    name: 'AdminLogin',
    setup() {
        const toast = useToast()
        return { toast }
    },
    data() {
        return {
            creds: {
                nombre_cuenta: '',
                password: ''
            },
        }
    },
    methods: {
        signin() {
            const { nombre_cuenta, password } = this.creds
            if (!nombre_cuenta || !password) {
                return this.toast.error("complete los campos!")
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/login', {
                    nombre_cuenta,
                    password
                }).then(response => {
                    if (response.data.success) {
                        localStorage.setItem('token', response.data.access_token)
                        localStorage.user = JSON.stringify(response.data.user)
                        if (typeof response.data.user.camareros[0] !== 'undefined')
                            localStorage.role = 'camarero'
                        if (typeof response.data.user.chefs[0] !== 'undefined')
                            localStorage.role = 'chef'
                        if (typeof response.data.user.cajeros[0] !== 'undefined')
                            localStorage.role = 'cajero'
                        if (typeof response.data.user.administradors[0] !== 'undefined')
                            localStorage.role = 'admin'
                        router.push('/admin/dashboard');
                        //this.$router.go('Home');
                    } else {
                        this.toast.error(response.data.message)
                    }
                }).catch(function (error) {
                    this.toast.error(error.response.data.message);
                });
            })

        },
    }
}
</script>