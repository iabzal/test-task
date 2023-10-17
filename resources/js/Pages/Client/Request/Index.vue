<template>
    <Head>
        <title>Заявки</title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row">
            <div class="col-md-3 col-12 mb-2">
                <button
                    class="btn btn-md btn-primary w-100"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-1"
                >
                    <i class="fa fa-plus-circle"></i> Создать заявку
                </button>
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
                                <tr v-for="( request, index ) in requestList.data" :key="index">
                                    <td class="fw-bold text-center">
                                        {{
                                            ++index +
                                            (requestList.current_page - 1) *
                                            requestList.per_page
                                        }}
                                    </td>
                                    <td>{{ request.title }}</td>
                                    <td>{{ request.category.name }}</td>
                                    <td class="text-center">
                                        {{ request.created_at }}
                                    </td>
                                    <td class="text-center">
                                        {{ request.status }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="requestList.links" align="end"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal-1" tabindex="-1" aria-labelledby="testModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="testModal">Создание заявки</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label>Тема</label>
                                        <input required type="text" class="form-control" placeholder="Тема" v-model="form.title">
                                        <div v-if="errors.title" class="alert alert-danger mt-2">
                                            {{ errors.title }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label>Сообщение</label><br>
                                        <textarea required class="form-control" placeholder="Сообщение" v-model="form.message"
                                                  cols="30" rows="5"></textarea>
                                        <div v-if="errors.message" class="alert alert-danger mt-2">
                                            {{ errors.message }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <Multiselect
                                            required
                                            @input="getSubcategoryById"
                                            v-model="form.category_id"
                                            placeholder="Выберите язык теста"
                                            :options="categories"
                                        />
                                        <div v-if="errors.category_id" class="alert alert-danger mt-2">
                                            {{ errors.category_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <Multiselect
                                            v-model="form.subcategory_id"
                                            placeholder="Выберите вид теста"
                                            :options="subcategories"
                                        />
                                        <div v-if="errors.subcategory_id" class="alert alert-danger mt-2">
                                            {{ errors.subcategory_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label>Логотип компании</label>
                                        <input type="file" class="form-control" @change="attachFile">
                                        <div v-if="errors.file" class="alert alert-danger mt-2">
                                            {{ errors.file }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary py-2 px-4" data-bs-dismiss="modal">
                                Отмена
                            </button>
                            <div>
                                <button type="submit" class="btn btn-primary py-2 px-4">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </form>
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
        requestList: Object,
        categories: Array,
    },
    setup() {
        const subcategories = ref([]);

        const form = reactive({
            category_id: null,
            subcategory_id: null,
            title: null,
            message: null,
            file: null,
        });

        const attachFile = (event) => {
            const file = event.target.files[0];
            form.file = file;
        };

        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );
        const handleSearch = () => {
            Inertia.get("/client/request", {
                q: search.value,
            });
        };

        const getSubcategoryById = (selectedValue) => {
            fetch(`/client/get-subcategories/${selectedValue}`)
                .then(data => {
                    form.test_type = [];
                    if (!data.ok) {
                        throw Error(data.status);
                    }
                    return data.json();
                }).then(data => {
                if (data.status) {
                    form.subcategory_id = null;
                    subcategories.value = data.message;
                }
            }).catch(e => {
                console.log(e);
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
                    });
                    handleSearch();
                },
            });
        }
        return {
            form,
            search,
            handleSearch,
            attachFile,
            submit,
            getSubcategoryById,
            subcategories,
        };
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
