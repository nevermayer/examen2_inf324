<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Ordenes</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Ordenes</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>#Factura</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(order, index) in orders" :key="index">
                                        <td>{{order.id}}</td>
                                        <td>{{order.total}}</td>
                                        <td>{{order.estado}}</td>
                                        <td>{{order.factura_id}}</td>
                                        <td>
                                            <button class="btn btn-main" @click="editar(order.id)"><span class="ti-pencil-alt"></span></button>
                                            <button type="button" class="btn btn-main-gradient" @click="eliminar(order.id)" v-if="user !== null && role=='camarero'">
                                                <span class="ti-trash"></span></button>
                                        </td>
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
import { useToast } from "vue-toastification"
export default {
    name: 'Ordenes',
    setup() {
        const toast = useToast()
        return { toast }
    },
    components: {
        DashboardLayout,
    },
    data() {
        return {
            orders: []
        }
    },

    mounted() {
        this.getOrders()
    },
    methods: {
        getOrders() {
            this.$axios.get('/api/orden', {
                headers: {
                    Authorization: `Bearer ${localStorage.authtoken}`
                }
            })
                .then(res => {
                    this.orders = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        }, eliminar(id) {
            this.$axios.delete('/api/orden/' + id)
                .then(res => {
                    this.toast.success("Se elimino orden")

                })
                .catch(error => {
                    console.log(error.response)
                })
        }
        , editar(id) {
            this.$router.push('/admin/ordenes/' + id)
        }, editar(id) {
            this.$router.push('/admin/ordenes/' + id)
        }
    }, computed: {
        user() {
            return this.$store.getters.getUser
        },
        role() {
            return this.$store.getters.getRole
        }
    }
}
</script>
