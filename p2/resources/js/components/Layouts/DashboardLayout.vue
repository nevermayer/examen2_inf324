<template>
    <div>
        <input type="checkbox" id="sidebar-toggle">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3 class="brand">
                    <span class="ti-bolt"></span>
                    <span>ScoM</span>
                </h3>
                <label for="sidebar-toggle" class="ti-menu-alt"></label>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li v-if="user !== null">
                        <router-link to="/admin/dashboard">
                            <span class="ti-home"></span>
                            <span>Principal</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='chef')">
                        <router-link to="/admin/productos">
                            <span class="ti-agenda"></span>
                            <span>Productos</span>
                        </router-link>
                    </li>

                    <li v-if="user !== null">
                        <router-link to="/admin/ordenes">
                            <span class="ti-clipboard"></span>
                            <span>Ordenes</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='cajero')">
                        <router-link to="/admin/facturas">
                            <span class="ti-receipt"></span>
                            <span>Facturas</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && role=='admin'">
                        <router-link to="/admin/usuarios" >
                            <span class="ti-user"></span>
                            <span>Usuarios</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && role=='admin'">
                        <router-link to="/admin/auditorias" >
                            <span class="ti-bookmark-alt"></span>
                            <span>Auditorias</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='cajero')">
                        <router-link to="/admin/clientes">
                            <span class="ti-user"></span>
                            <span>Clientes</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='camarero')">
                        <router-link to="/admin/mesas">
                            <span class="ti-layout-grid2"></span>
                            <span>Mesas</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='chef')">
                        <router-link to="/admin/ingredientes">
                            <span class="ti-list"></span>
                            <span>Ingredientes</span>
                        </router-link>
                    </li>
                    <li v-if="user !== null && (role=='admin' || role=='chef')">
                        <router-link to="/admin/solicitudchefs">
                            <span class="ti-write"></span>
                            <span>Solicitud Ingredientes</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>


        <div class="main-content">

            <header>
                <div class="search-wrapper">
                    <span class="ti-search"></span>
                    <input type="search" placeholder="Buscar...">
                </div>

                <div class="social-icons">
                    <span @click="signout" class="ti-power-off"></span>
                    <div></div>
                </div>
            </header>

            <main>
                <slot></slot>
            </main>

        </div>
    </div>
</template>

<script>
export default {
    name: 'DashboardLayout',
    methods: {
        signout() {
            this.$axios.get('/api/logout', {
                headers: {
                    Authorization: `Bearer ${localStorage.token}`
                }
            })
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('role')
            this.$router.push('/admin/login')
        }
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