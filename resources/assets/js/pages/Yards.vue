<style scoped lang="scss">


</style>

<template>
    <div id="yards" class="page">
        <div class="grid-container">
            <div class="grid-x">
                <div class="large-12 medium-12 small-12 columns">
                    <router-link :to="{ name: 'newyard' }" class="add-yard-button">+ Add Yard</router-link>
                </div>
            </div>
        </div>
        <yard-map></yard-map>
    </div>
</template>

<script>
    import YardMap from '../components/yards/YardMap.vue';

    export default {
        components: {
            YardMap
        }
    }
</script>