<template>
    <Head>
        <title>Панель управления - Приложение онлайн-тестирования</title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row">

            <a href="/admin/companies" class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                                    <i class="fas fa-building fs-3"></i>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Компании</h2>
                                    <h3 class="fw-extrabold mb-1">{{ companies }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Компании</h2>
                                    <h3 class="fw-extrabold mb-1">{{ companies }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="/admin/departments" class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-warning rounded me-4 me-sm-0">
                                    <i class="fas fa-project-diagram fs-3"></i>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Отделы</h2>
                                    <h3 class="fw-extrabold mb-1">{{ departments }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Отделы</h2>
                                    <h3 class="fw-extrabold mb-1">{{ departments }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="/admin/employees" class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                                    <i class="fas fa-users fs-3"></i>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Сотрудники</h2>
                                    <h3 class="fw-extrabold mb-1">{{ employees }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Сотрудники</h2>
                                    <h3 class="fw-extrabold mb-1">{{ employees }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="/admin/tests" class="col-12 col-sm-6 col-xl-3 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                    <i class="fas fa-question-circle fs-3"></i>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Тесты</h2>
                                    <h3 class="fw-extrabold mb-1">{{ tests }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Тесты</h2>
                                    <h3 class="fw-extrabold mb-1">{{ tests }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
</template>

<script>
// Импорт макета администратора
import LayoutAdmin from '../../../Layouts/Admin.vue';

// Импорт Head из Inertia
import {
    Head,
} from '@inertiajs/inertia-vue3';

export default {

    // Макет
    layout: LayoutAdmin,

    // Регистрация компонентов
    components: {
        Head
    },

    // Props
    props: {
        companies: Number,
        departments: Number,
        employees: Number,
        tests: Number,
    }

}

</script>

<style>

</style>
