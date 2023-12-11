<template>
    <dashboard-layout>
        <div>
            <h2 class="dash-title">Vista General de Ingresos</h2>

            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Ingreso de hoy</h5>
                            <h4>Bs. {{ingresos.dia}}</h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Ingreso de la semana</h5>
                            <h4>Bs. {{ingresos.semana}}</h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Ingreso del mes</h5>
                            <h4>Bs. {{ingresos.mes}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </dashboard-layout>
</template>

<script>
import DashboardLayout from '@/components/Layouts/DashboardLayout.vue'

export default {
    components: {
        DashboardLayout
    },
    name: 'Dashboard',
    data() {
        return {
            ingresos: []
        }
    },
    mounted() {
        this.getIngreso()
    },
    methods: {
        getIngreso() {
            this.$axios.get('/api/reportes')
            .then(res => {
                this.ingresos=res.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
    }
}
</script>