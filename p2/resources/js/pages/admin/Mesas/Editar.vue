<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Mesa</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="mesa.nombre" class="form-control" placeholder="Nombre de mesa">
                            </div>
                            <div class="form-group">
                                <label for="">Minima Capacidad</label>
                                <input type="number" v-model="mesa.min_capacidad" class="form-control"
                                    placeholder="Minima Capacidad">
                            </div>
                            <div class="form-group">
                                <label for="">Maxima Capacidad</label>
                                <input type="number" v-model="mesa.max_capacidad" class="form-control"
                                    placeholder="Maxima Capacidad">
                            </div>
                             <div class="form-group">
                                <label for="">Status</label>
                                <select v-model="mesa.status" class="form-control">
                                    <option value="libre">libre</option>
                                    <option value="ocupado">ocupado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editmesa" class="btn btn-main">Submit</button>
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
        this.mesaid = this.$route.params.id
        this.$axios.get('/api/mesa/' + this.mesaid)
            .then(datos => {
                this.mesa.nombre = datos.data.nombre
                this.mesa.min_capacidad = datos.data.min_capacidad
                this.mesa.max_capacidad= datos.data.max_capacidad
                this.mesa.status= datos.data.status                
            })
    },
    data() {
        return {
            mesaid: null,
            mesa: {
                nombre: '',
                min_capacidad: '',
                max_capacidad: '',
                status: ''
            }
        }
    }, methods: {
        editmesa() {
            this.$axios.put('/api/mesa/' + this.mesaid, this.mesa, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/mesas')
                })
        }
    }
}
</script>