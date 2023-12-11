<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Usuario</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre de cuenta</label>
                                <input type="text" v-model="user.nombre_cuenta" class="form-control"
                                    placeholder="Nombre de cuenta">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="user.nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Apellido Paterno</label>
                                <input type="text" v-model="user.apellido_pat" class="form-control"
                                    placeholder="Paterno">
                            </div>
                            <div class="form-group">
                                <label for="">Apellido Materno</label>
                                <input type="text" v-model="user.apellido_mat" class="form-control"
                                    placeholder="Materno">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" v-model="user.password" class="form-control"
                                    placeholder="*********">
                            </div>
                            <div class="form-group">
                                <label for="">Repetir Password</label>
                                <input type="password" v-model="user.password_confirmation" class="form-control"
                                    placeholder="*********">
                            </div>
                            <div class="form-group">
                                <label for="">Rol</label>
                                <select v-model="user.role" class="form-control">
                                    <option value="">Cargo</option>
                                    <option value="admin">Administrador</option>
                                    <option value="cajero">Cajero</option>
                                    <option value="camarero">Camarero</option>
                                    <option value="chef">Chef</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Activo</label>
                                <select v-model="user.activo" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Super Usuario</label>
                                <select v-model="user.super_usuario" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Turno</label>
                                <select v-model="user.turno" class="form-control">
                                    <option value="">Choose</option>
                                    <option value="mañana">mañana</option>
                                    <option value="tarde">tarde</option>
                                    <option value="noche">noche</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addUser" class="btn btn-main">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'

export default {
    name: 'Agregar',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            categories: [],
            user: {
                nombre_cuenta: '',
                nombre: '',
                apellido_pat: '',
                apellido_mat: '',
                password: '',
                password_confirmation: '',
                role: '',
                super_usuario: '',
                activo: '',
                turno: '',
            }
        }
    },
    mounted() {

    },
    methods: {
        addUser() {

            if (!this.user.nombre_cuenta || !this.user.nombre || !this.user.role || !this.user.password) {
                return this.$alertify.error('Incomplete form data')
            }

            this.$axios.post('/api/register', this.user, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/usuarios')
                })
                .catch(error => {
                    if (error.response.data.message) {
                        return this.$alertify.error(error.response.data.message)
                    }
                    this.$alertify.error(Object.values(error.response.data)[0][0])
                })
        }
    }
}
</script>

<style lang="css">
.pad-1 {
    padding: 1rem
}
</style>