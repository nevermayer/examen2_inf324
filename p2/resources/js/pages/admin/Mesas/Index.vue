<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Mesas</h2>

            <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/mesas/add')"><span class="ti-plus"></span>
                    Nuevo mesa</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Mesas</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Min capacidad</th>
                                        <th>Max capacidad</th>
                                        <th>Status</th>
                                        <th>Camarero</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(mesa, index) in mesas" :key="index">
                                        <td>{{ mesa.id }}</td>
                                        <td>{{ mesa.nombre }}</td>
                                        <td>{{ mesa.min_capacidad }}</td>
                                        <td>{{ mesa.max_capacidad }}</td>
                                        <td>{{ mesa.status }}</td>
                                        <td>{{ mesa.camarero_id }}</td>
                                        <td><button class="btn btn-main" @click="tomarOrden(mesa.id)">Tomar Orden</button>
                                            <button class="btn btn-main-gradient" @click="editar(mesa.id)"><span
                                                    class="ti-pencil-alt"></span></button>
                                            <button type="button" class="btn btn-main"
                                                @click="modalCamarero(mesa.id, mesa.camarero_id)" v-if="user !== null && role=='admin'">Asignar
                                                Camarero</button>
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
    <modal v-if="additemModal" @close="additemModal = false">
        <template #header>
            <h4 class="modal-title" id="myModalLabel">Asignar Camarero</h4>
        </template>
        <template #body>
            <div class="col-md-12">
                <label>Camareros</label>
                <select v-model="camarero_id" class="form-control">
                    <option value="">Asigna un camarero</option>
                    <option v-for="(camarero, index) in camareros" :key="index" :value="`${camarero.id}`">
                        {{ camarero.apellido_pat }} {{ camarero.apellido_mat }} {{ camarero.nombre }}</option>
                </select>
            </div>
        </template>
        <template #footer>
            <div class="modal-footer">
                <button class="btn btn-main-gradient" @click="clean()">
                    Cerrar
                </button>
                <button class="btn btn-main" @click="asignarCamarero()">
                    Asignar
                </button>
            </div>
        </template>
    </modal>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'
import modal from '@/components/Modal.vue'
export default {
    name: 'mesas',
    components: {
        DashboardLayout,
        modal
    },
    data() {
        return {
            additemModal: false,
            mesas: [],
            mesa_id: '',
            camareros: [],
            camarero_id: '',
        }
    },
    mounted() {
        this.getmesas()
    },
    methods: {
        getmesas() {
            this.$axios.get('/api/mesa', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(res => {
                    this.mesas = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        editar(id) {
            this.$router.push('/admin/mesas/' + id)
        },
        tomarOrden(id) {
            this.$router.push('/menu/' + id)
        },
        modalCamarero(id, camarero_id) {
            this.mesa_id = id
            this.camarero_id = camarero_id || ''
            this.additemModal = true
            this.$axios.get('/api/getcamarero', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(res => {
                    this.camareros = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        clean() {
            this.additemModal = false
        },
        asignarCamarero() {
            this.additemModal = false
            const data = {
                mesa_id: this.mesa_id,
                camarero_id:this.camarero_id
            }
            this.$axios.post('/api/setcamarero', data, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    location.reload()
                })
                .catch(error => {
                    if (error.response.data.message) {
                        return this.$alertify.error(error.response.data.message)
                    }
                    this.$alertify.error(Object.values(error.response.data)[0][0])
                })
        },
    }, computed: {
        user() {
            return this.$store.getters.getUser
        },
        role(){
            return this.$store.getters.getRole
        }
    }
}
</script>