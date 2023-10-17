<template>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="/">
            <img class="navbar-brand-dark" src=""/>
            <img class="navbar-brand-light" src=""/>
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- sidebar -->
    <CompanySidebar  v-if="$page.props.auth.company"/>

    <main class="content" v-if="$page.props.auth.company">

        <!-- navbar -->
        <CompanyNavbar />
        <slot />

    </main>


    <div class="container" v-else>
        <slot />
    </div>

</template>

<script>
import CompanySidebar from "../Components/Client/Sidebar.vue";
import CompanyNavbar from "../Components/Client/Navbar.vue";

export default {

    //register components
    components: {
        CompanyNavbar,
        CompanySidebar,
    },
}

</script>

<style>

</style>
