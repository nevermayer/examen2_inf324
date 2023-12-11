<template>
    <div class="front-wrapper">
        <div class="front-sidebar">
            <div class="brand">
                <img src="../assets/img/logo.svg" alt="">
            </div>
            <div class="front-sidemenu">
                <ul>
                    <li :class="active === 0? 'active' : ''" @click="active = 0">
                        <div @click="getPlatillos()">
                            <img src="../assets/img/platillo.svg" alt="">
                            <h3>Platillos</h3>
                        </div>
                    </li>
                    <li :class="active === 1? 'active' : ''" @click="active = 1">
                        <div @click="getPostres()">
                            <img src="../assets/img/postre.svg" alt="">
                            <h3>Postres</h3>
                        </div>
                    </li>
                    <li :class="active === 2? 'active' : ''" @click="active = 2">
                        <div @click="getBebidas()">
                            <img src="../assets/img/bebida.svg" alt="">
                            <h3>Bebidas</h3>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <Nav :cart="cart" :categories="categories" :user="user" />
        <div class="front-main">
            <div class="main-grid">
                <div class="menu-section">
                    <h3>{{selectedMenu? selectedMenu.name : 'PRODUCTOS DISPONIBLES'}}s</h3>

                    <div class="menu-grid">
                        <div :style="`background-image: url(${item.imagen})`" class="menu-card"
                            v-for="(item, index) in productos" :key="index">
                            <div>
                                <span class="bg-main-gradient item-price">
                                    <span>Bs</span> {{item.precio}}
                                </span>
                            </div>
                            <div>
                                <span class="item-name">{{item.nombre}}</span>
                            </div>

                            <button class="btn btn-main-gradient" @click="updateCart(item)">
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="cart-section">
                    <div class="cart-card">
                        <div class="cart-header">
                            <h3>Nueva Orden</h3>
                            <small>Productos</small>
                        </div>
                        <div class="cart-body">
                            <div class="cart-items">
                                <div class="cart-item" v-for="(item, index) in cart" :key="index">
                                    <div class="cart-info">
                                        <span class="ti-trash" @click="dropItem(index)"></span>
                                        <div>
                                            <h5>{{item.nombre}}</h5>
                                            <small>Bs. {{(Number(item.precio) *
                                            Number(item.qty)).toLocaleString()}}</small>
                                        </div>
                                    </div>
                                    <div class="cart-controls">
                                        <input type="text" readonly :value="item.qty">
                                        <div>
                                            <span class="ti-angle-up" @click="updateItemQty(index, item, 1)"></span>
                                            <span class="ti-angle-down" @click="updateItemQty(index, item, 0)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-sum">
                                <div class="cart-address">
                                </div>
                                <div>
                                    <div class="price-flex">
                                        <small>Subtotal</small>
                                        <small>{{cartTotal.toLocaleString()}} Bs</small>
                                    </div>
                                    <div class="price-flex">
                                        <small>Total</small>
                                        <h4>{{cartTotal.toLocaleString()}} Bs</h4>
                                    </div>
                                </div>
                                <div class="cart-pay-btn">
                                    <button v-if="role=='camarero' && user !== null" class="btn btn-success"
                                        @click=createOrder>
                                        Confirmar la Orden
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal v-if="showAddressModal" @close="showAddressModal = false">
            <h4 slot="header">Provide your address</h4>
            <div slot="body">
                <div class="form-group">
                    <label for="">Your address</label>
                    <input type="text" class="form-control" v-model="address" placeholder="No 230, Abba road" />
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import Nav from '@/components/Nav.vue'
import modal from '@/components/Modal.vue'
import { useToast } from "vue-toastification";
export default {
    name: 'carta',
    setup() {
      const toast = useToast()
      return { toast }
    },
    components: {
        Nav,
        modal
    }, data() {
        return {
            categories: [{ "name": "Platillo" }, { "name": "Postre" }, { "name": "Bebida" }],
            active: 0,
            cart: [],
            productos: [],
            address: '',
            showAddressModal: false,
            usuario: '',
            mesa_id:0
        }
    }, mounted() {
        this.getPlatillos()
        this.getCart()
        if (localStorage.user)
            this.usuario = JSON.parse(localStorage.user)
    }, methods: {
        getPlatillos() {
            this.$axios.get('/api/platillos')
                .then(res => {
                    this.productos = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getPostres() {
            this.$axios.get('/api/postres')
                .then(res => {
                    this.productos = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getBebidas() {
            this.$axios.get('/api/bebidas')
                .then(res => {
                    this.productos = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
        },
        getCart() {
            if (localStorage.getItem('cart') === null)
                localStorage.setItem('cart', '[]')
            this.cart = JSON.parse(localStorage.cart)
        },
        updateCart(menuitem) {
            let cartDB = localStorage.getItem('cart')
            if (!cartDB || JSON.parse(cartDB).length < 1) {
                menuitem.qty = 1
                let cart = [menuitem]
                localStorage.setItem('cart', JSON.stringify(cart))
                this.cart.push(menuitem)
                this.toast.success("Producto agregado al pedido!")
                return
            }
            let cart = JSON.parse(cartDB)
            let isFound = false
            cart.map(item => {
                if (item.id === menuitem.id) {
                    isFound = true
                    item.qty += 1;
                    return item;
                }
            })
            if (!isFound) {
                menuitem.qty = 1
                cart.push(menuitem)
            }
            this.cart = cart
            localStorage.setItem('cart', JSON.stringify(cart))
            this.toast.success("Producto agregado al pedido!")
        },
        updateItemQty(index, item, flag) {
            if (flag === 0 && Number(item.qty) > 1) {
                item.qty = Number(item.qty) - 1
            } else {
                item.qty = Number(item.qty) + 1
            }
            this.cart[index] = item
            localStorage.setItem('cart', JSON.stringify(this.cart))
            this.toast.success("Pedido actualizado!")
        },
        dropItem(index) {
            this.cart.splice(index, 1)
            localStorage.setItem('cart', JSON.stringify(this.cart))
            this.toast.success("Producto quitado!")
        },
        createOrder() {
            const token = localStorage.token
            const data = {
                mesa_id: this.$route.params.id,
                camarero_id: this.usuario.camareros[0].id,
                total: this.cartTotal,
                items: JSON.stringify(this.cart)
            }
            this.$axios.post('/api/ordenes', data, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(res => {
                localStorage.removeItem('cart')
                this.address = ''
                this.cart = []
                this.toast.success(res.data.message)

            }).catch(error => {
                if (error) {
                    return console.log(error.response.data.message)
                }
                this.toast.error(Object.values(error.response.data)[0][0])
            })
        },
        close() {

        },
    },
    computed: {
        user() {
            return this.$store.getters.getUser
        },
        role() {
            return this.$store.getters.getRole
        },
        selectedMenu() {
            return this.categories[this.active]
        },
        cartTotal() {
            let total = 0
            this.cart.map(item => {
                total += Number(item.precio) * Number(item.qty)
            })
            return total
        }, reference() {
            let text = "";
            let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"

            for (let i = 0; i < 10; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length))
            }
            return text;
        },
        validateCheckoutData() {
            //const {name, email, city, address, phone, zip} = this.checkout

            //return !name || !email || !city || !address || !phone || !zip
            return false
        }
    }
}
</script>