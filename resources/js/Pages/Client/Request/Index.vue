<template>
    <Head>
        <title>Сотрудники</title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="Введите ключевое слово и нажмите Enter..."
                                />
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <thead class="thead-dark">
                                <tr class="border-0">
                                    <th
                                        class="border-0 rounded-start"
                                        style="width: 5%"
                                    >
                                        №
                                    </th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Полное Имя</th>
                                    <th class="border-0">Возраст</th>
                                    <th class="border-0">Пол</th>
                                    <th class="border-0"></th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                <tr v-for="( employee, index ) in employees.data" :key="index">
                                    <td class="fw-bold text-center">
                                        {{
                                            ++index +
                                            (employees.current_page - 1) *
                                            employees.per_page
                                        }}
                                    </td>
                                    <td>{{ employee.email }}</td>
                                    <td>{{ employee.last_name + ' ' + employee.first_name }} {{ employee.patronymic ? employee.patronymic : '' }}</td>
                                    <td class="text-center">
                                        {{ employee.age }}
                                    </td>
                                    <td class="text-center">
                                        {{ employee.gender ? employee.gender === 'M' ? 'Мужчина' : 'Женщина' : '' }}
                                    </td>
                                    <td class="text-center">
                                        <Link
                                            :href="`/company/employees/${employee.id}/edit`"
                                            class="btn btn-sm btn-info border-0 shadow me-2"
                                            type="button">
                                            <i class="fa fa-pencil-alt"></i>
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="employees.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Импорт макета
import LayoutCompany from '../../../Layouts/Company.vue';

// Импорт компонента Pagination
import Pagination from "../../../Components/Pagination.vue";

// Импорт Head и Link из Inertia
import { Head, Link } from "@inertiajs/inertia-vue3";

// Импорт ref из Vue
import { ref } from "vue";

// Импорт Inertia
import { Inertia } from "@inertiajs/inertia";

// Импорт Sweet Alert2
import Swal from "sweetalert2";

export default {
    // Макет
    layout: LayoutCompany,

    // Регистрация компонентов
    components: {
        Head,
        Link,
        Pagination,
    },

    // Props
    props: {
        employees: Object,
    },

    // Инициализация Composition API
    setup() {
        // Определение состояния поиска
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        // Определение метода поиска
        const handleSearch = () => {
            Inertia.get("/company/employees", {
                // Отправка параметра "q" со значением из состояния "search"
                q: search.value,
            });
        };

        // Возврат данных
        return {
            search,
            handleSearch,
        };
    },
};
</script>

<style></style>
