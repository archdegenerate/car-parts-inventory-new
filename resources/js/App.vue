<template>
    <div>
        <nav>
            <router-link to="/cars">Cars</router-link>
            <router-link to="/parts">Parts</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App"
};
</script>
