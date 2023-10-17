<template>
    <Head>
        <title>Регистрация</title>
    </Head>
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
            <div>
                <Link
                    class="btn btn-secondary"
                    href="/"
                >
                    <i class="fa fa-angle-left"></i> Назад
                </Link>
            </div>
            <hr>
            <div v-if="errors.message" class="alert alert-danger mt-2">
                {{ errors.message }}
            </div>
            <div v-if="$page.props.session.error" class="alert alert-danger mt-2">
                {{ $page.props.session.error }}
            </div>
            <form @submit.prevent="submit" class="mt-4">

                <div class="form-group mb-4">
                    <label for="login">ФИО</label>
                    <div class="input-group">
                        <input required type="text" class="form-control" v-model="form.fullName"
                               placeholder="Введите ФИО">
                    </div>
                    <div v-if="errors.fullName" class="alert alert-danger mt-2">
                        {{ errors.fullName }}
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="login">Email</label>
                    <div class="input-group">
                        <input required type="email" class="form-control" v-model="form.email"
                               placeholder="Введите Email">
                    </div>
                    <div v-if="errors.email" class="alert alert-danger mt-2">
                        {{ errors.email }}
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="login">Логин</label>
                    <div class="input-group">
                        <input required type="text" class="form-control" v-model="form.login"
                               placeholder="Введите логин">
                    </div>
                    <div v-if="errors.login" class="alert alert-danger mt-2">
                        {{ errors.login }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group mb-4">
                        <label for="password">Пароль</label>
                        <div class="input-group">
                            <input required type="password" placeholder="Введите Пароль" class="form-control"
                                   v-model="form.password">
                        </div>
                        <div v-if="errors.password" class="alert alert-danger mt-2">
                            {{ errors.password }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group mb-4">
                        <label for="password">Подтвердите пароль</label>
                        <div class="input-group">
                            <input required type="password" placeholder="Введите подтверждение пароля" class="form-control"
                                   v-model="form.password_confirmation">
                        </div>
                        <div v-if="errors.password_confirmation" class="alert alert-danger mt-2">
                            {{ errors.password_confirmation }}
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gray-800">СОХРАНИТЬ</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import {reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import Swal from "sweetalert2";

export default {
    components: {
        Head, Link
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = reactive({
            fullName: '',
            email: '',
            login: '',
            password: '',
            password_confirmation: ''
        });
        const submit = () => {
            Inertia.post('/client/create', {
                fullName: form.fullName,
                email: form.email,
                login: form.login,
                password: form.password,
                password_confirmation: form.password_confirmation,
            }, {
                onSuccess: () => {
                    // Отображение сообщения об успешном обновлении
                    Swal.fire({
                        title: 'Вы успешно зарегистрированы!',
                        text: '',
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
        }
    }
}
</script>
