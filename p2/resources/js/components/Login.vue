<template>
    <div class="account-form">
        <h3>Introduzca datos de la cuenta</h3>
        <div class="form-group">
            <label for="">Email o cuenta</label>
            <input type="text" v-model="data.email" class="form-control" placeholder="example@gmail.com" />
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" v-model="data.password" class="form-control" placeholder="**********" />
        </div>

        <div class="form-group">
            <button class="btn btn-main-gradient btn-block" @click="$emit('eventact', {eventType: 'signin'})">Acceder</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    name: 'Login'
}
</script>