<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Cliente</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">CI o NIT</label>
                                <input type="text" v-model="cliente.ci" class="form-control"
                                    placeholder=" Introduce CI o NIT">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="cliente.nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Paterno</label>
                                <input type="text" v-model="cliente.apellido_pat" class="form-control"
                                    placeholder="apellido paterno">
                            </div>
                            <div class="form-group">
                                <label for="">Materno</label>
                                <input type="text" v-model="cliente.apellido_mat" class="form-control"
                                    placeholder="apellido materno">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" v-model="cliente.email" class="form-control"
                                    placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" v-model="cliente.password" class="form-control"
                                    placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="number" v-model="cliente.telefono" class="form-control"
                                    placeholder="Telefono">
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <select v-model="cliente.activo" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">No Activo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addcliente" class="btn btn-main">Submit</button>
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
            cliente: {
                ci:'',
                nombre: '',
                apellido_pat: '',
                apellido_mat: '',
                email: '',
                password: '',
                telefono:'',
                activo:''
            }
        }
    },
    mounted() {

    },
    methods: {
        addcliente() {

            if (!this.cliente.nombre || !this.cliente.apellido_pat || !this.cliente.apellido_mat || !this.cliente.email) {
                return this.$alertify.error('Incomplete form data')
            }
            this.$axios.post('/api/cliente', this.cliente, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/clientes')
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