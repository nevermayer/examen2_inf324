<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Usuario</h2>
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
                                <button type="button" @click="editUser" class="btn btn-main">Submit</button>
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
    name: "Editar",
    components: {
        DashboardLayout
    },
    mounted: function () {
        this.userid = this.$route.params.id
        this.$axios.get('/api/user/' + this.userid)
            .then(datos => {
                this.user.nombre_cuenta = datos.data.data.nombre_cuenta
                this.user.nombre = datos.data.data.nombre
                this.user.apellido_pat = datos.data.data.apellido_pat
                this.user.apellido_mat = datos.data.data.apellido_mat
                this.user.role = datos.data.cargo
                this.user.super_usuario = datos.data.data.super_usuario
                this.user.activo = datos.data.data.activo
                this.user.turno = datos.data.data.turno
                if (typeof datos.data.data.administradors[0] !== 'undefined')
                    this.user.role = 'admin'
                if (typeof datos.data.data.camareros[0] !== 'undefined')
                    this.user.role = 'camarero'
                if (typeof datos.data.data.chefs[0] !== 'undefined')
                    this.user.role = 'chef'
                if (typeof datos.data.data.cajeros[0] !== 'undefined')
                    this.user.role = 'cajero'
            })
    },
    data() {
        return {
            userid: null,
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
    }, methods: {
        editUser() {
            this.$axios.put('/api/user/' + this.userid, this.user, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/usuarios')
                })
        }
    }
}
</script>