<template>
    <div>
        <div class="spinner-border text-success"></div>
        <label for="visually-hidden">Loading....</label>
        {{ title }}....
    </div>
</template>

<script>
export default {
    name:"Loading",
    props:{
        title:String
    }
}
</script>

<style lang="scss" scoped>

</style>