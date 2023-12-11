<template>
  <section id="hero-area">
    <img class="img-responsive" src="../assets/header.jpg" alt="">
  </section>
  <nav id="navigation">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">
                    <img src="../assets/logo3.png" alt="Logo">
                  </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right" id="top-nav">
                    <li><a href="#hero-area">Inicio</a></li>
                    <li><a href="#about-us">Acerca de nosotros</a></li>
                    <li><a href="#price">menu</a></li>
                    <li><a href="#footer">contactos</a></li>
                    <li>
                      <router-link to="/account">
                        <span>Login</span>
                      </router-link>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
          </div>
        </div><!-- .col-md-12 close -->
      </div><!-- .row close -->
    </div><!-- .container close -->
  </nav><!-- header close -->
  <section id="slider">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
            <div class="title">
              <h3>Nuestra <span>Especialidad</span></h3>
            </div>
            <div class="carrousel">
              <div class="conteCarrousel">
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-1.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-2.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-3.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-4.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-1.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-2.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-3.jpg" alt="">
                </div>
                <div class="itemCarrousel">
                  <img class="img-responsive" src="../assets/img/slider/slider-img-4.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
        </div><!-- .col-md-12 close -->
      </div><!-- .row close -->
    </div><!-- .container close -->
  </section><!-- slider close -->
  <section id="about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block">
            <img class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms" src="../assets/cooker-img.png"
              alt="cooker-img">
            <h1 class="heading wow fadeInUp" data-wow-duration="400ms" data-wow-delay="500ms">Tu Restaurant
              <span> LA LLAJUITA</span><br> Un poco de nosotros <span>Inicios</span>
            </h1>
            <p class="wow fadeInUp  " data-wow-duration="600ms" data-wow-delay="900ms">La Llajuita se caracteriza por su
              constante innovación de platos, creaciones nuevas y la utilización de los productos más finos y frescos
              del mercado como también en el uso de las últimas técnicas gastronómicas mundiales, todo ello gracias al
              espíritu emprendedor, que además somos apasionados de la cocina Boliviana mostrando nuestros comidas al
              país.</p>
          </div>
        </div><!-- .col-md-12 close -->
      </div><!-- .row close -->
    </div><!-- .containe close -->
  </section><!-- #call-to-action close -->
  <section id="price">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block">
            <h1 class="heading wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">Nuestros <span>MENU</span>
              Los <span>PRECIOS</span></h1>
            <p class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">tenemos un menu variado de los
              distintos platos bolivianos. </p>
            <div class="pricing-list">
              <div class="title">
                <h3>Lo que hay <span>en esta semana</span></h3>
              </div>
              <div class="row">
                <div class="col-md-6" v-for="(item, index) in productos" :key="index">
                  <div class="pricing-entry d-flex ftco-animate">
                    <div class="img" :style="`background-image: url(${item.imagen});`">
                    </div>
                    <div class="desc pl-3">
                      <div class="d-flex text align-items-center">
                        <h3><span>{{ item.nombre }}</span></h3>
                        <span class="price">Bs. {{ item.precio }}</span>
                      </div>
                      <div class="d-block">
                        <p>{{ item.descripcion }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- .col-md-12 close -->
      </div><!-- .row close -->
    </div><!-- .containe close -->
  </section><!-- #price close -->
  <section id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="block wow fadeInLeft" data-wow-delay="200ms">
            <h3>INFORMACION de <span>CONTACTO</span></h3>
            <div class="info">
              <ul>
                <li>
                  <h4><i class="fa fa-phone"></i>Telefono</h4>
                  <p>752 97272 - 700 00000</p>

                </li>
                <li>
                  <h4><i class="fa fa-map-marker"></i>Direccion</h4>
                  <p>2046 calle falsa 123456</p>
                </li>
                <li>
                  <h4><i class="fa fa-envelope"></i>E mail</h4>
                  <p>jramoss2@fcpn.edu.bo - pruebacontrolador@gmail.com</p>

                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="block block wow fadeInLeft">
            <h3>Opina <span>Sugerencias</span></h3>
            <form>
              <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
                <input type="text" required class="form-control" v-model="contacto.nombre" id="exampleInputEmail1"
                  placeholder="Nombre aqui....">
              </div>
              <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="800ms">
                <input type="email" required class="form-control" v-model="contacto.email" placeholder="email aqui...">
              </div>
              <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1000ms">
                <textarea class="form-control" required rows="3" v-model="contacto.mensaje"
                  placeholder="tu mensaje o sugerencia aqui..."></textarea>
              </div>
            </form>
            <a type="button" class="btn btn-default wow bounceIn" data-wow-duration="500ms" data-wow-delay="1300ms"
              @click="enviar()" role="button">envia tu mensaje</a>
          </div>
        </div><!-- .col-md-8 close -->

      </div><!-- .row close -->
    </div><!-- .containe close -->
  </section><!-- #footer close -->
  <footer id="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="block">
            <p>Copyright &copy; 2022</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
import Nav from '@/components/Nav.vue'
export default {
  name: 'home',
  components: {
    Nav
  }, data() {
    return {
      contacto: { nombre: '', email: '', mensaje: '' },
      productos: [],
    }
  }, mounted() {
    this.getPlatillos()
  },
  methods: {
    getPlatillos() {
      this.$axios.get('/api/platillos')
        .then(res => {
          this.productos = res.data
        })
        .catch(error => {
          console.log(error.response)
        })
    },
    enviar() {
      //alert(this.contacto.nombre + " " + this.contacto.email + " " + this.contacto.mensaje)
      this.$axios.post('/api/send-mail', this.contacto, {
        headers: {
          Authorization: `Bearer ${localStorage.token}`
        }
      })
        .then(() => {
          alert('su sugerencia o comentario sera revisada....')
        })
        .catch(error => {
          if (error.response.data.message) {
            return this.$alertify.error(error.response.data.message)
          }
          this.$alertify.error(Object.values(error.response.data)[0][0])
        })
      this.contacto.nombre = ''
      this.contacto.email = ''
      this.contacto.mensaje = ''
    }
  }
}
</script>
<style scoped>
@import "@/assets/css/bootstrap.min.css";
@import "@/assets/css/main.css";

.carrousel {
  width: 100%;
}

.conteCarrousel {
  width: 3050px;
  height: 200px;
  display: flex;
}

.itemCarrousel {
  position: relative;
  width: 100%;
  height: 100%;
}

.itemCarrouselTarjeta {
  width: 100%;
  height: 100%;
}

.itemCarrouselArrows {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
}

.itemCarrouselArrows>i:hover {
  cursor: pointer;
}

#itemCarrousel-1 {
  background-color: rgb(226, 50, 50);
}

#itemCarrousel-2 {
  background-color: rgb(50, 200, 226);
}

#itemCarrousel-3 {
  background-color: rgb(200, 226, 50);
}

.conteCarrouselController {
  width: 100%;
  display: flex;
  justify-content: space-evenly;
}

.conteCarrouselController>a {
  text-decoration: none;
  font-size: 2em;
  color: grey;
}

.itemCarrouselArrows>a>i {
  color: white;
}

.pricing-entry {
  width: 100%;
  display: block;
  margin-bottom: 30px;
}

.pricing-entry .img {
  width: 60px;
  height: 60px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
}

.pricing-entry .desc {
  width: calc(100% - 60px);
}

.pricing-entry .desc p {
  margin-bottom: 0;
}

.pricing-entry .text {
  width: 100%;
  display: block;
  position: relative;
  z-index: 0;
}

.pricing-entry .text:after {
  position: absolute;
  bottom: 35%;
  left: 0;
  right: 0;
  content: '';
  width: 100%;
  height: 1px;
  border-bottom: 1px dashed #bf7e06;
  z-index: -1;
}

.pricing-entry .text h3 {
  width: calc(100% - 80px);
  font-size: 18px;
}

.pricing-entry .text h3 span {
  background: #121618;
  background: url(../images/bg_4.jpg) no-repeat fixed;
  padding-right: 20px;
}

.pricing-entry .text .price {
  width: 80px;
  text-align: right;
  background: #121618;
  background: url(../images/bg_4.jpg) no-repeat fixed;
  font-size: 20px;
}

.d-flex {
  display: -webkit-box !important;
  display: -ms-flexbox !important;
  display: flex !important;
}

.img,
.blog-img,
.user-img {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
}

.pl-3,
.px-3 {
  padding-left: 1rem !important;
}

.d-block {
  display: block !important;
}
</style>