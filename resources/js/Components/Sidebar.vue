<template>
    <nav
        id="sidebarMenu"
        class="sidebar d-lg-block bg-gray-800 text-white collapse"
        data-simplebar
    >
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4"
            >
                <div class="collapse-close d-md-none">
                    <a
                        href="#sidebarMenu"
                        data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu"
                        aria-expanded="true"
                        aria-label="Toggle navigation"
                    >
                        <svg
                            class="icon icon-xs"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/admin/dashboard'),
                    }"
                >
                    <Link
                        href="/admin/dashboard"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                               <i class="fas fa-home"></i>
                            </span>
                            <span class="sidebar-text">Главная</span>
                        </span>
                    </Link>
                </li>

                <li
                    role="separator"
                    class="dropdown-divider mt-2 mb-2 border-gray-700"
                ></li>

                <li
                    class="nav-item"
                    :class="{ active: $page.url.startsWith('/admin/users') }"
                >
                    <Link
                        href="/admin/questions"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <span class="sidebar-text">Заявки</span>
                        </span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
//import Link
import { Link } from "@inertiajs/inertia-vue3";

export default {
    //register components
    components: {
        Link,
    },
};
</script>

<style></style>
