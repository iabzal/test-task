<template>
    <Head>
        <title>Заявки </title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <Link
                            href="/admin/users/create"
                            class="btn btn-md btn-primary border-0 shadow w-100"
                            type="button"
                        ><i class="fa fa-plus-circle"></i>
                            Добавить </Link
                        >
                    </div>
                    <div class="col-md-9 col-12 mb-2">
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
                                    <th class="border-0">Тема</th>
                                    <th class="border-0">Сообщение</th>
                                    <th class="border-0">Категория</th>
                                    <th class="border-0">Подкатегория</th>
                                    <th
                                        class="border-0 rounded-end"
                                        style="width: 15%"
                                    >
                                        Действие
                                    </th>
                                </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                <tr
                                    v-for="(
                                            request, index
                                        ) in requestList.data"
                                    :key="index"
                                >
                                    <td class="fw-bold text-center">
                                        {{
                                            ++index +
                                            (requestList.current_page - 1) *
                                            requestList.per_page
                                        }}
                                    </td>
                                    <td>{{ request.title }}</td>
                                    <td>
                                        {{ request.message.length > 20 ? request.message.substring(0, 30) + '...' : request.message }}
                                    </td>
                                    <td class="text-center">
                                        {{ request.category.name }}
                                    </td>
                                    <td class="text-center">
                                        {{ request.subcategory ? request.subcategory.name : "" }}
                                    </td>
                                    <td class="text-center">
                                        <Link
                                            v-if="request.status === 'Создан'"
                                            :href="`/admin/question/${request.id}/answer`"
                                            class="btn btn-sm btn-info border-0 shadow me-2"
                                            type="button"
                                        ><i class="fa fa-reply"></i
                                        ></Link>
                                        <div v-else>
                                            Отвечен
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="requestList.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Импорт макета
import LayoutAdmin from "../../../Layouts/Admin.vue";

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
    layout: LayoutAdmin,

    // Регистрация компонентов
    components: {
        Head,
        Link,
        Pagination,
    },

    // Props
    props: {
        requestList: Object,
    },

    // Инициализация Composition API
    setup() {
        // Определение состояния поиска
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        // Определение метода поиска
        const handleSearch = () => {
            Inertia.get("/admin/users", {
                // Отправка параметра "q" со значением из состояния "search"
                q: search.value,
            });
        };

        // Определение метода удаления
        const destroy = (id) => {
            Swal.fire({
                title: "Вы уверены?",
                text: "Вы не сможете восстановить это!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Отмена",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Да, удалить!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/users/${id}`);

                    Swal.fire({
                        title: "Удалено!",
                        text: "Сотрудник успешно удален!.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        };

        // Возврат данных
        return {
            search,
            handleSearch,
            destroy,
        };
    },
};
</script>

<style></style>
