<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Auditorias</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Auditorias</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id Auditoria</th>
                                        <th>Id Usuario</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(auditoria, index) in auditoria" :key="index" >
                                        <td>{{auditoria.id}}</td>
                                        <td>{{auditoria.id_usuario}}</td>
                                        <td>{{auditoria.fecha}}</td>
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
    name: 'Auditoria',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            auditoria: []
        }
    },
    mounted() {
        this.getAuditoria()
    },
    methods: {
        getAuditoria() {
            this.$axios.get('/api/auditoria', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.auditoria = res.data
                
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/auditorias/'+id)
        },
    }
}
</script>