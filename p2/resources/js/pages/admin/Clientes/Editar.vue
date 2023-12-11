<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar cliente</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
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
                                <button type="button" @click="editcliente" class="btn btn-main">Submit</button>
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
    mounted: function () {0
        this.clienteid = this.$route.params.id
        this.$axios.get('/api/cliente/' + this.clienteid)
            .then(datos => {
                this.cliente.nombre = datos.data.nombre
                this.cliente.apellido_pat = datos.data.apellido_pat
                this.cliente.apellido_mat= datos.data.apellido_mat
                this.cliente.email= datos.data.email
                this.cliente.password= datos.data.password
                this.cliente.telefono= datos.data.telefono
                this.cliente.activo= datos.data.activo
                
            })
    },
    data() {
        return {
            clienteid: null,
            cliente: {
                nombre: '',
                apellido_pat: '',
                apellido_mat: '',
                email: '',
                password: '',
                telefono:'',
                activo:''
            }
        }
    }, methods: {
        editcliente() {
            this.$axios.put('/api/cliente/' + this.clienteid, this.cliente, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/clientes')
                })
        }
    }
}
</script>