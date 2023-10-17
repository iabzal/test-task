<template>
    <Head>
        <title>Вход</title>
    </Head>
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
            <div v-if="errors.message" class="alert alert-danger mt-2">
                {{ errors.message }}
            </div>
            <div v-if="$page.props.session.error" class="alert alert-danger mt-2">
                {{ $page.props.session.error }}
            </div>
            <form @submit.prevent="submit" class="mt-4">

                <div class="form-group mb-4">
                    <label for="login">Логин</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-user"></i>
                            </span>
                        <input required type="text" class="form-control" v-model="form.login" placeholder="Логин">
                    </div>
                    <div v-if="errors.login" class="alert alert-danger mt-2">
                        {{ errors.login }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group mb-4">
                        <label for="password">Пароль</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa fa-lock"></i>
                                </span>
                            <input required type="password" placeholder="Пароль" class="form-control"
                                   v-model="form.password">
                        </div>
                        <div v-if="errors.password" class="alert alert-danger mt-2">
                            {{ errors.password }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-top mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember">
                            <label class="form-check-label mb-0" for="remember">
                                Запомнить меня
                            </label>
                        </div>
                    </div>

                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gray-800">ВОЙТИ</button>
                    <Link
                        class="mt-3 text-center text-decoration-underline"
                        href="/register"
                    >
                        Регистрация
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import {reactive} from 'vue';
import {Inertia} from '@inertiajs/inertia';

export default {
    components: {
        Link,
        Head
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = reactive({
            login: '',
            password: '',
        });
        const submit = () => {
            Inertia.post('/client/login', {
                login: form.login,
                password: form.password,
            });
        }
        return {
            form,
            submit
        }
    }
}
</script>
