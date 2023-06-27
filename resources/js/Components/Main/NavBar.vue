<template>
    
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <Link class="navbar-brand" :href="route('dashboard')">Home</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             <li class="nav-item">
                <Link class="nav-link active" aria-current="page" :href="route('student')">Student Entry</Link>
             </li>
            </ul>

        <!-- Authentication -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Login -->
                <span>
                    <Link class="nav-link active" aria-current="page" :href="route('login')">
                        <button type="login" class="btn btn-outline-primary" style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .9rem;">Login</button>
                    </Link>
                </span>
                <!-- Register -->
                <span>
                    <Link class="nav-link active" aria-current="page" :href="route('register')">
                        <button type="register" class="btn btn-outline-secondary" style="--bs-btn-padding-y: .3rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .9rem;">Register</button>
                    </Link>
                </span>
            </div>

        </div>
        <!-- </div> -->
    </nav>

</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    }
}

</script>

<style lang="scss" scoped>
    
</style>