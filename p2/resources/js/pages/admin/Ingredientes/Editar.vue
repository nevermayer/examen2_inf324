<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Ingrediente</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="ingrediente.nombre" class="form-control"
                                    placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="text" v-model="ingrediente.imagen" class="form-control"
                                    placeholder="URL imagen">
                            </div>
                            <div class="form-group">
                                <label for="">Stoc</label>
                                <input type="text" v-model="ingrediente.stock" class="form-control" placeholder="stock">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Vencimiento</label>
                                <input type="date" v-model="ingrediente.fecha_vencimiento" class="form-control"
                                    placeholder="fecha_vencimiento">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editIngrediente" class="btn btn-main"> Editar</button>
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
        this.ingredienteid = this.$route.params.id
        this.$axios.get('/api/ingrediente/' + this.ingredienteid)
            .then(datos => {
                this.ingrediente.nombre = datos.data.nombre
                this.ingrediente.stock = datos.data.stock
                this.ingrediente.imagen = datos.data.imagen
                this.ingrediente.fecha_vencimiento = datos.data.fecha_vencimiento

            })
    },
    data() {
        return {
            ingredienteid: null,
            ingrediente: {
                nombre: '',
                stock: '',
                imagen: '',
                fecha_vencimiento: '',
            }
        }
    }, methods: {
        editIngrediente() {
            this.$axios.put('/api/ingrediente/' + this.ingredienteid, this.ingrediente, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/ingredientes')
                })
        }
    }
}
</script>