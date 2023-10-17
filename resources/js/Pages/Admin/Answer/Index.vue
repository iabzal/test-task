<template>
    <Head>
        <title>Ответ на заявку</title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form @submit.prevent="submit">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <b>Тема:</b>
                                                <p>{{question.title}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <b>Сообщение:</b><br>
                                                <p>{{question.message}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <b>Категория:</b><br>
                                                <p>{{question.category.name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <b>Подкатегория:</b><br>
                                                <p>{{question.subcategory.name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12" v-if="question.file">
                                            <img :src="'/storage/' + question.file" alt="" style="width: 300px;">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <b>Ответ:</b><br>
                                                <textarea v-model="form.answer" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary py-2 px-4">
                                        Ответить
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
import LayoutAdmin from "../../../Layouts/Admin.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import {reactive} from "vue";
import Swal from "sweetalert2";
import {Inertia} from "@inertiajs/inertia";

export default {
    layout: LayoutAdmin,

    components: {
        Head,
        Link,
    },

    props: {
        question: Object,
    },

    setup(props) {
        const form = reactive({
            answer: null
        });

        const submit = () => {
            Inertia.post(`/admin/question/${props.question.id}/answer`, {
                answer: form.answer,
            }, {
                onSuccess: () => {
                    // Отображение сообщения об успешном обновлении
                    Swal.fire({
                        title: 'Успех!',
                        text: 'Ответ успешно сохранен.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });
        }
        return {
            form,
            submit
        };
    },
};
</script>
