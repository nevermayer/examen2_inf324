<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Nuevo Producto</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="Producto.nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <input type="text" v-model="Producto.descripcion" class="form-control"
                                    placeholder="descripcion">
                            </div>
                            <div class="form-group">
                                <label for="">Imagen url</label>
                                <input type="text" v-model="Producto.imagen" class="form-control"
                                    placeholder="URL Imagen">
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="number" v-model="Producto.precio" class="form-control"
                                    placeholder="precio">
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input type="number" v-model="Producto.cantidad" class="form-control"
                                    placeholder="cantidad">
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <select v-model="Producto.producto" class="form-control">
                                    <option selected value="platillo">Platillo</option>
                                    <option value="postre">Postre</option>
                                    <option value="bebida">Bebida</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tiempo de elaboracion</label>
                                <input type="number" v-model="Producto.tiempo_elaboracion" class="form-control"
                                    placeholder="tiempo en elaborar el platillo">
                            </div>
                            <div class="form-group">
                                <label for="">Grado de alcohol</label>
                                <input type="number" v-model="Producto.grado_alcoholico" class="form-control"
                                    placeholder="grado alcoholico">
                            </div>
                            <div class="form-group">
                                <button type="button" @click="addProducto" class="btn btn-main">Submit</button>
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
            Producto: {
                nombre: '',
                descripcion: '',
                imagen:'',
                precio: '',
                cantidad: '',
                producto: '',
                tiempo_elaboracion:'',
                grado_alcoholico:''
            }
        }
    },
    mounted() {

    },
    methods: {
        addProducto() {

            if (!this.Producto.nombre || !this.Producto.descripcion || !this.Producto.precio || !this.Producto.cantidad) {
                return this.$alertify.error('Incomplete form data')
            }
            this.$axios.post('/api/producto', this.Producto, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(() => {
                    this.$router.push('/admin/productos')
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