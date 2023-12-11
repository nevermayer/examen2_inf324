<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Ingredientes</h2>
                    
            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/ingredientes/add')"><span class="ti-plus"></span>Ingrediente Nuevo</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Ingredientes</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Stoc</th>
                                        <th>Fecha de Vencimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ingrediente, index) in ingredientes" :key="index" >
                                        <td>{{ingrediente.id}}</td>
                                        <td>{{ingrediente.nombre}}</td>
                                        <td>{{ingrediente.stock}}</td>
                                        <td>{{ingrediente.fecha_vencimiento}}</td>
                                        <td><button class="btn" @click="editar(ingrediente.id)"><span class="ti-pencil-alt"></span></button></td>
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
    name: ' Ingredientes',
    components: {
        DashboardLayout,
    },
    data() {
        return {
            ingredientes: []
        }
    },
    mounted() {
        this.getIngredientes()
    },
    methods: {
        getIngredientes() {
            this.$axios.get('/api/ingredientes', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.ingredientes = res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/ingredientes/'+id)
        },
    }
}
</script>