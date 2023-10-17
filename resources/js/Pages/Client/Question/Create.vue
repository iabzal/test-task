<template>
    <Head>
        <title>Создание заявки</title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div v-if="errors.hasQuestion" class="alert alert-warning">
            {{ errors.hasQuestion }}
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="container">
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
                                                <label>Файл</label>
                                                <input type="file" class="form-control" @change="attachFile">
                                                <div v-if="errors.file" class="alert alert-danger mt-2">
                                                    {{ errors.file }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <Link href="/client/request" class="btn btn-secondary py-2 px-4">
                                        Назад
                                    </Link>
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        Отправить
                                    </button>
                                </div>
                            </form>
                        </div>
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
        categories: Array,
    },
    setup() {
        const answer = ref(null);
        const subcategories = ref([]);
        const modalButton = ref(null);

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
            if (form.subcategory_id) {
                formData.append('subcategory_id', form.subcategory_id);
            }

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
            attachFile,
            submit,
            getSubcategoryById,
            subcategories,
            viewAnswer,
            answer,
            modalButton,
        };
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
