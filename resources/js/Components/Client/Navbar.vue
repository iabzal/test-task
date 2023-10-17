<template>
    <nav class="navbar navbar-top bg-primary">
        <div class="container px-0">
            <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                <h4 class="text-white mb-0">Заявки</h4>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown ms-lg-3">
                        <Link class="dropdown-item d-flex align-items-center text-white" href="/logout" method="POST" as="button">
                            <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Выйти
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>

//import Link
import { Link } from '@inertiajs/inertia-vue3';

export default {

    //register component
    components: {
        Link,
    }
}

</script>

<style scoped>
    .dropdown-item:hover, .dropdown-item:focus {
        background-color: transparent;
    }
</style>
