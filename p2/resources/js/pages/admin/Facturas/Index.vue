<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Facturas</h2>
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/facturas/add')"><span
                        class="ti-plus"></span> Nueva Factura</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Facturas</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Cajero Id</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(Factura, index) in facturas" :key="index" >
                                        <td>{{Factura.id}}</td>
                                        <td>{{Factura.total}}</td>
                                        <td>{{Factura.fecha}}</td>
                                        <td>{{Factura.cajero_id}}</td>
                                        <td><button class="btn" @click="editar(Factura.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: 'facturas',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            facturas: []
        }
    },
    mounted() {
        this.getfacturas()
    },
    methods: {
        getfacturas() {
            this.$axios.get('/api/facturas', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                console.log(res.data)
                this.facturas = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/facturas/'+id)
        },
    }
}
</script>