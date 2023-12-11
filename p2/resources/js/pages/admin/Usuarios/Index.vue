<template>
    <dashboard-layout>
        <div slot="main-content">
            <h2 class="dash-title">Usuarios</h2>
            
           <div class="page-action">
                <button class="btn btn-main" @click="$router.push('/admin/usuarios/add')"><span class="ti-plus"></span> Nuevo usuario</button>
            </div>
            <section class="recent">
                <div class="">
                    <div class="activity-card">
                        <h3>Lista de Usuarios</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre de cuenta</th>
                                        <th>Nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Turno</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(user, index) in users" :key="index" >
                                        <td>{{user.id}}</td>
                                        <td>{{user.nombre_cuenta}}</td>
                                        <td>{{user.nombre}}</td>
                                        <td>{{user.apellido_pat}}</td>
                                        <td>{{user.apellido_mat}}</td>
                                        <td>{{user.turno}}</td>
                                        <td>
                                        <button class="btn btn-success" @click="editar(user.id)"><span class="ti-pencil-alt"></span></button>
                                        <button type="button" class="btn btn-danger"
                                                @click="eliminar(user.id)" v-if="user !== null && role=='admin'"><span class="ti-trash"></span></button>
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
    name: 'Usuarios',
    setup() {
        const toast = useToast()
        return { toast }
    },
    components: {
        DashboardLayout,
    },
    data() {
        return {
            users: []
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            this.$axios.get('/api/users', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            .then(res => {
                this.users = res.data.data
            })
            .catch(error => {
                console.log(error.response)
            })
        }, 
        eliminar(id) {
           this.$axios.delete('/api/user/'+id)
           .then((res) => {
                console.log(res);
                this.toast.success("Se elimino usuario")
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        editar(id){
            this.$router.push('/admin/usuarios/'+id)
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
<style scoped>
@import "@/assets/css/bootstrap.min.css";
</style>