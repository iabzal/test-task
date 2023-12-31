<template>
    <Head>
        <title>Заявки</title>
    </Head>
    <div class="row">
        <div class="col-md-3 col-12 mb-2">
            <Link
                href="/client/request/add"
                class="btn btn-md btn-primary w-100"
            >
                <i class="fa fa-plus-circle"></i> Создать заявку
            </Link>
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
                                <th class="border-0">Категория</th>
                                <th class="border-0">Время создания</th>
                                <th class="border-0">Статус</th>
                            </tr>
                            </thead>
                            <div class="mt-2"></div>
                            <tbody>
                            <tr v-for="( request, index ) in questionList.data" :key="index">
                                <td class="fw-bold text-center">
                                    {{
                                        ++index +
                                        (questionList.current_page - 1) *
                                        questionList.per_page
                                    }}
                                </td>
                                <td>{{ request.title }}</td>
                                <td>{{ request.category.name }}</td>
                                <td class="text-center">
                                    {{ request.created_at }}
                                </td>
                                <td class="text-center">
                                        <span v-if="request.status === 'Создан'">
                                            {{ request.status }}
                                        </span>
                                    <a href="javascript:void(0);" class="text-decoration-underline" v-else
                                       @click="viewAnswer(request.id)"
                                       style="color: #0000b4;"
                                       data-bs-toggle="modal"
                                       data-bs-target="#modal-2">
                                        {{ request.status }}
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :links="questionList.links" align="end"/>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" id="modal-2" tabindex="-1" aria-labelledby="testModal2" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="testModal2">Ответ на заявку</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div><b>Название:</b></div>
                        <div>{{ answer?.question.title }}</div>
                        <div><b>Сообщение:</b></div>
                        <div>{{ answer?.question.message }}</div>
                        <hr>
                        <div><b>Ответ:</b></div>
                        <div>{{ answer?.answer }}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary py-2 px-4" data-bs-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutClient from '../../../Layouts/Client.vue';
import Pagination from "../../../Components/Pagination.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {ref, reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import Swal from "sweetalert2";
import Multiselect from '@vueform/multiselect'

export default {
    layout: LayoutClient,
    components: {
        Head,
        Link,
        Pagination,
        Multiselect,
    },
    props: {
        errors: Object,
        questionList: Object,
    },
    setup() {
        const answer = ref(null);

        const form = reactive({
            category_id: null,
            subcategory_id: null,
            title: null,
            message: null,
            file: null,
        });

        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );
        const handleSearch = () => {
            Inertia.get("/client/request", {
                q: search.value,
            });
        };

        const submit = () => {
            const formData = new FormData();

            formData.append('title', form.title);
            formData.append('message', form.message);
            formData.append('category_id', form.category_id);
            formData.append('subcategory_id', form.subcategory_id);

            if (form.file) {
                formData.append('file', form.file);
            }

            Inertia.post('/client/request', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onSuccess: () => {
                    Swal.fire({
                        title: 'Успешно!',
                        text: 'Ваша заявка доставлена!.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        modalButton.value.click();
                    });
                },
            });
        }

        const viewAnswer = (questionId) => {
            fetch(`/client/answer?question_id=${questionId}`)
                .then(data => {
                    if (!data.ok) {
                        throw Error(data.status);
                    }
                    return data.json();
                }).then(data => {
                answer.value = data
            }).catch(e => {
                console.log(e);
            });
        }

        return {
            form,
            search,
            handleSearch,
            submit,
            viewAnswer,
            answer,
        };
    },
};
</script>
