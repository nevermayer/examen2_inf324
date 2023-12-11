<template>
    <div class="account-wrapper">
        <div>
            <div>
                <div class="account-header">
                    <h3><span class="ti-bolt"></span>Scom</h3>
                    <small>Platillos, Postres, Bebidas de locura!</small>
                </div>

                <div class="account-tabs">
                    <button :class="isActive === 0 ? 'is-active' : ''" @click="isActive = 0">Acceda</button>
                    <button :class="isActive === 1 ? 'is-active' : ''" @click="isActive = 1">Registrese</button>
                </div>

                <div class="account-form-wrapper">
                    <component :is="compsArr[isActive]" :data="compsData[isActive]" @eventact="processEvent">
                    </component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Login from '@/components/Login.vue'
import Register from '@/components/Register.vue'
import { useToast } from "vue-toastification"
export default {
    name: 'Account',
    setup() {
        const toast = useToast()
        return { toast }
    },
    data() {
        return {
            compsArr: [
                Login,
                Register,
            ],
            isActive: 0,
            compsData: [
                {
                    email: '',
                    password: '',
                },
                {
                    ci: '',
                    nombre: '',
                    apellido_pat: '',
                    apellido_mat: '',
                    email: '',
                    password: '',
                    telefono: '',
                }
            ]
        }
    },
    methods: {
        processEvent(payload) {
            if (payload.eventType === 'signin') {
                this.signin()
            } else if (payload.eventType === 'signup') {
                this.signup()
            }
        },
        signin() {
            const { email, password } = this.compsData[this.isActive]

            if (!email || !password) {
                return this.toast.error("complete los campos!")
            }

            this.$axios.post('/api/auth/login', {
                email,
                password
            })
                .then(res => {
                    if (res.data.success) {
                        localStorage.user = JSON.stringify(res.data.user)
                        localStorage.role = res.data.role
                        if (res.data.role == 'cliente')
                            this.$router.push('/menu')
                        else {
                            localStorage.setItem('token', res.data.access_token)
                            this.$router.push('/admin/dashboard')
                        }
                    }
                    else
                        this.toast.error(res.message)
                })
                .catch(error => {
                    this.toast.error(error)
                })
        },
        signup() {
            let { ci, nombre, apellido_pat, apellido_mat, email, password, telefono, } = this.compsData[this.isActive]

            if (!ci || !email || !password || !nombre || !apellido_pat || !apellido_mat || !telefono) {
                return this.toast.error('Complete los datos para el registro');
            }

            this.$axios.post('/api/cliente', {
                ci, nombre, apellido_pat, apellido_mat, email, password, telefono,activo:'1'
            })
                .then(res => {
                    this.compsData[this.isActive] = {
                        ci: '',
                        nombre: '',
                        apellido_pat: '',
                        apellido_mat: '',
                        email: '',
                        password: '',
                        telefono: '',
                    }
                    this.toast.success('Complete los datos para el registro');
                })
                .catch(error => {
                    this.$alertify.error(error.response.data.message)
                })

        }
    }
}
</script>
