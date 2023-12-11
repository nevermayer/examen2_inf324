<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Solicitud de Ingrediente</h2>
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/solicitudchefs/add')"><span
                        class="ti-plus"></span> Nueva Solicitud</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Solicitudes</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Chef</th>
                                        <th>Ingrediente</th>
                                        <th>Cantidad</th>
                                        <th>Status</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(solicitudchef, index) in solicitudchefs" :key="index">
                                        <td>{{solicitudchef.id}}</td>
                                        <td>{{solicitudchef.chef}}</td>
                                        <td>{{solicitudchef.ingrediente}}</td>
                                        <td>{{solicitudchef.cantidad}}</td>
                                        <td>{{solicitudchef.status}}</td>
                                        <td>{{solicitudchef.fecha}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'

export default {
    name: 'SolicitudChefs',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            solicitudchefs: []
        }
    },
    mounted() {
        this.getSolicitudChefs()
    },
    methods: {
        getSolicitudChefs() {
            this.$axios.get('/api/solicitud-chef', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(res => {
                    console.log(res.data)
                    this.solicitudchefs = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        editar(id) {
            this.$router.push('/admin/solicitudchefs/' + id)
        },
    }
}
</script>