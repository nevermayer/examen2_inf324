<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Solicitud</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Id Ingrediente</label>
                                <input type="number" v-model="SolicitudChef.id_chef" class="form-control" placeholder="Id ingrediente">
                            </div>
                            <div class="form-group">
                                <label for="">Id Chef</label>
                                <input type="number" v-model="SolicitudChef.id_chef" class="form-control"
                                    placeholder="Id Chef">
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" v-model="SolicitudChef.cantidad" class="form-control"
                                    placeholder="cantidad">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editSolicitudChef" class="btn btn-main">Submit</button>
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
        this.solicitudchefid = this.$route.params.id
        this.$axios.get('/api/solicitudchef/' + this.solicitudchefid)
            .then(datos => {
                this.SolicitudChef.id_ingrediente = datos.data.id_ingredientes
                this.SolicitudChef.id_chef = datos.data.id_chef
                this.SolicitudChef.cantidad = datos.data.cantidad
                this.SolicitudChef.status = datos.data.status
                this.SolicitudChef.fecha = datos.data.fecha
            })
    },
    data() {
        return {
            SolicitudChefid: null,
            SolicitudChef: {
                id_ingrediente: '',
                id_chef: '',
                cantidad: '',
                fecha: '',
            }
        }
    }, methods: {
        edit() {
            this.$axios.put('/api/solicitudchef/' + this.solicitudchefid, this.SolicitudChef, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/solicitudchefs')
                })
        }
    }
}
</script>