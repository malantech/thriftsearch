<style>

</style>

<template>
    <div id="yards" class="page">
        <yard-map></yard-map>

        <add-yard-button></add-yard-button>

        <router-view></router-view>
    </div>
</template>

<script>
    import YardMap from '../components/yards/YardMap.vue';
    import AddYardButton from '../components/yards/AddYardButton.vue';

    export default {
        components: {
            YardMap,
            AddYardButton
        }
    }
</script>
