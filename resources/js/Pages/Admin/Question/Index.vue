<template>
    <Head>
        <title>Заявки </title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
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
                                        ) in questionList.data"
                                    :key="index"
                                >
                                    <td class="fw-bold text-center">
                                        {{
                                            ++index +
                                            (questionList.current_page - 1) *
                                            questionList.per_page
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
                                            :href="`/admin/question/${request.id}`"
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
                        <Pagination :links="questionList.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from "../../../Layouts/Admin.vue";
import Pagination from "../../../Components/Pagination.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    layout: LayoutAdmin,

    components: {
        Head,
        Link,
        Pagination,
    },

    // Props
    props: {
        questionList: Object,
    },

    setup() {
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        const handleSearch = () => {
            Inertia.get("/admin/users", {
                // Отправка параметра "q" со значением из состояния "search"
                q: search.value,
            });
        };

        return {
            search,
            handleSearch,
        };
    },
};
</script>
