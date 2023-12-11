<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Editar Producto</h2>
            <section class="recent">
                <div class="">
                    <div class="activity-card pad-1">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" v-model="Producto.nombre" class="form-control" placeholder="nombre">
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
                            <h2>Ingredientes</h2>
                            <div id="flex">
                                <div v-for="ingrediente in Ingredientes" style="flex">
                                    <label for="">{{ingrediente.nombre}}:</label>
                                    <input type="checkbox" :value="`${ingrediente.id}`" v-model="Producto.items">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" @click="editProducto" class="btn btn-main">Actualizar</button>
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
        this.productoid = this.$route.params.id
        this.$axios.get('/api/producto/' + this.productoid)
            .then(datos => {
                this.Producto.nombre = datos.data.nombre
                this.Producto.descripcion = datos.data.descripcion
                this.Producto.precio = datos.data.precio
                this.Producto.imagen = datos.data.imagen
                this.Producto.cantidad = datos.data.cantidad
                if (datos.data.platillos.length > 0) {
                    this.Producto.platillo_id = datos.data.platillos[0].id
                    this.Producto.tiempo_elaboracion = datos.data.platillos[0].tiempo_elaboracion
                    this.Producto.producto = 'platillo'
                    this.$axios.get('/api/platillo/' + datos.data.platillos[0].id)
                        .then(datos => {
                            this.Producto.items = datos.data.map(function (a) {
                                return a.id;
                            })
                        });
                }
                if (datos.data.postres.length > 0) {
                    this.Producto.postre_id = datos.data.postres[0].id
                    this.Producto.tiempo_elaboracion = datos.data.postres[0].tiempo_elaboracion
                    this.Producto.producto = 'postre'
                    this.$axios.get('/api/postre/' + datos.data.platillos[0].id)
                        .then(datos => {
                            this.Producto.items = datos.data.map(function (a) {
                                return a.id;
                            })
                        });
                }
                if (datos.data.bebidas.length > 0) {
                    this.Producto.bebida_id = datos.data.bebidas[0].id
                    this.Producto.grado_alcoholico = datos.data.bebidas[0].grado_alcoholico
                    this.Producto.producto = 'bebida'
                    this.$axios.get('/api/bebida/' + datos.data.platillos[0].id)
                        .then(datos => {
                            this.Producto.items = datos.data.map(function (a) {
                                return a.id;
                            })
                        });
                }
            })
        this.$axios.get('/api/ingredientes/')
            .then(datos => {
                this.Ingredientes = datos.data
            })

    },
    data() {
        return {
            Productoid: null,
            Producto: {
                nombre: '',
                descripcion: '',
                precio: '',
                cantidad: '',
                imagen:'',
                producto: '',
                tiempo_elaboracion: 0,
                grado_alcoholico: 0,
                platillo_id: 0,
                bebida_id: 0,
                items: [],
                postre_id: 0
            },
            Ingredientes: []
        }
    }, methods: {
        editProducto() {
            this.$axios.put('/api/producto/' + this.productoid, this.Producto, {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
                .then(data => {
                    this.$router.push('/admin/productos')
                })
        }
    }
}
</script>
<style scoped>
div#flex {
    display: flex;
    justify-content: space-around;
}
</style>