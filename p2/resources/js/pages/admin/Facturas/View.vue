<template>
    <dashboard-layout>
        <section id="print">
            <strong>FACTURA #{{Factura.id}}</strong>
            <div class="mainText">
                <div>
                    <strong>CI o NIT:</strong> {{Cliente.id}}
                    <br /><strong>Nombre:</strong> {{Cliente.apellido_pat}} {{Cliente.nombre}}
                </div>
                <div>
                </div>
                <div>
                    <strong>Total :</strong> {{Factura.total}}Bs
                    <br><strong>Fecha :</strong> {{Factura.fecha}}
                </div>
                <div>
                    <p></p>
                    <p></p>
                </div>
            </div>
            <table class="table table-borderless factura">
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Nombre</th>
                        <th>Precio Unitario</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in Detalle" :key="index">
                        <td>{{item.cantidad}}</td>
                        <td>{{item.nombre}}</td>
                        <td>{{item.precio}}</td>
                        <td>{{item.precio*item.cantidad}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Total Factura</th>
                        <th>Bs. {{Factura.total}}</th>
                    </tr>
                </tfoot>
            </table>
            <p class="centered">Gracias!
            </p>
        </section>

        <div>
            <div style="flex">
                <button class="btn btn-main" @click="print()">Imprimir Factura</button>
                <button class="btn btn-primary" @click="facturas()">Volver</button>
            </div>
        </div>
    </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'
export default {
    name: "ViewFactura",
    components: {
        DashboardLayout
    },
    mounted: function () {
        this.facturaid = this.$route.params.id
        this.$axios.get('/api/factura/' + this.facturaid)
            .then(datos => {
                this.Factura = datos.data.factura
                this.addItemsTable(datos.data.consumo)
                this.Cliente = datos.data.cliente
                this.Factura.fecha = this.Factura.fecha
            })
    },
    data() {
        return {
            facturaid: null,
            Factura: [],
            Detalle: [],
            Cliente: []
        }
    }, methods: {
        print() {
            window.print()
        }, facturas() { this.$router.push('/admin/facturas') },
        addItemsTable(item) {
            item.forEach(element => {
                element.productos.forEach(element => {
                    console.log(element.pivot.cantidad)
                    item.cantidad = element.pivot.cantidad
                    item.nombre = element.nombre
                    item.precio = element.precio
                    this.Detalle.push(item)
                    item = {}
                })
            })
        }
    }
}
</script>
<style scoped>
@import "@/assets/css/bootstrap.min.css";

@media print {
    body * {
        visibility: hidden;
    }

    #print,
    #print * {
        visibility: visible;
    }

}

.mainText {
    display: flex;
    justify-content: space-evenly;
}

.centered {
    text-align: center;
    align-content: center;
}
</style>