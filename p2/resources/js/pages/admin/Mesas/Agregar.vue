<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Mesa</h2>
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
                                <button type="button" @click="addmesa" class="btn btn-main">Submit</button>
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
            mesa: {
                nombre: '',
                min_capacidad: '',
                max_capacidad: '',
                status: ''
            }
        }
    },
    mounted() {

    },
    methods: {
        addmesa() {

            if (!this.mesa.nombre || !this.mesa.min_capacidad || !this.mesa.max_capacidad || !this.mesa.status) {
                return this.$alertify.error('Incomplete form data')
            }
            this.$axios.post('/api/mesa', this.mesa, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/mesas')
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