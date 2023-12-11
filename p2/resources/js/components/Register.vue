<template>
    <div class="account-form">
        <h3>Crea tu Cuenta ahora</h3>
        <div class="form-group">
            <label for="">Area de Registro</label>
        </div>
        <div class="form-group">
            <label for="">CI o NIT</label>
            <input type="number" v-model="data.ci" class="form-control" placeholder="CI or NIT" />
        </div>
        <div class="form-group">
            <label for="">Nombres</label>
            <input type="text" v-model="data.nombre" class="form-control" placeholder="John doe" />
        </div>
        <div class="form-group">
            <label for="">Apellido Paterno</label>
            <input type="text" v-model="data.apellido_pat" class="form-control" placeholder="Paterno" />
        </div>
        <div class="form-group">
            <label for="">Apellido Materno</label>
            <input type="text" v-model="data.apellido_mat" class="form-control" placeholder="Materno" />
        </div>

        <div class="form-group">
            <label for="">Email o nombre de cuenta</label>
            <input type="text" v-model="data.email" class="form-control" placeholder="example@gmail.com" />
        </div>
        
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" v-model="data.password" class="form-control" placeholder="**********" />
        </div>
        <div class="form-group">
            <label for="">Telefono</label>
            <input type="number" v-model="data.telefono" class="form-control" placeholder="numero de telefono" />
        </div>
        <div class="form-group">
            <button class="btn btn-main-gradient btn-block" @click="$emit('eventact', {eventType: 'signup'})">Registro</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    name: 'Register'
}
</script>