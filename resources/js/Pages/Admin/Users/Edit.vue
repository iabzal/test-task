<template>
    <Head>
        <title>Редактировать Администратора </title>
    </Head>
    <div class="container-fluid mb-5 mt-2">
        <div class="row">
            <div class="col-md-12">
                <Link href="/admin/users" class="btn btn-md btn-primary border-0 shadow mb-3" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i> Назад</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-user"></i> Редактировать Администратора</h5>
                        <hr>
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Полное Имя</label>
                                        <input type="text" class="form-control" placeholder="Введите Имя Администратора" v-model="form.name">
                                        <div v-if="errors.name" class="alert alert-danger mt-2">
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="Введите NISN Администратора" v-model="form.email">
                                        <div v-if="errors.email" class="alert alert-danger mt-2">
                                            {{ errors.email }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Пароль</label>
                                        <input type="password" class="form-control" placeholder="Введите пароль" v-model="form.password">
                                        <div v-if="errors.password" class="alert alert-danger mt-2">
                                            {{ errors.password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Подтвердите пароль</label>
                                        <input type="password" class="form-control" placeholder="Введите подтверждение пароля" v-model="form.password_confirmation">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary border-0 shadow me-2">Изменить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Импорт макета
import LayoutAdmin from '../../../Layouts/Admin.vue';

// Импорт Head и Link из Inertia
import {
    Head,
    Link
} from '@inertiajs/inertia-vue3';

// Импорт reactive из Vue
import { reactive } from 'vue';

// Импорт Inertia
import { Inertia } from '@inertiajs/inertia';

// Импорт Sweet Alert2
import Swal from 'sweetalert2';

export default {

    // Макет
    layout: LayoutAdmin,

    // Регистрация компонентов
    components: {
        Head,
        Link
    },

    // Props
    props: {
        errors: Object,
        departments: Array,
        user: Object
    },

    // Инициализация Composition API
    setup(props) {

        // Определение объекта form с помощью reactive
        const form = reactive({
            name: props.user.name,
            email: props.user.email,
            password: '',
            password_confirmation: ''
        });

        // Метод "submit"
        const submit = () => {

            // Отправка данных на сервер
            Inertia.put(`/admin/users/${props.user.id}`, {
                // Данные
                name: form.name,
                email: form.email,
                password: form.password,
                password_confirmation: form.password_confirmation
            }, {
                onSuccess: () => {
                    // Отображение сообщения об успешном обновлении
                    Swal.fire({
                        title: 'Успех!',
                        text: 'Сотрудник успешно обновлен.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
            });

        }

        // Возврат данных
        return {
            form,
            submit,
        };

    }

}

</script>

<style>

</style>
