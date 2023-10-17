<template>
    <Head>
        <title>Вход для администратора</title>
    </Head>
    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3>Менеджер</h3>
        </div>
        <form @submit.prevent="submit" class="mt-4">
            <div class="form-group mb-4">
                <label for="email">Адрес электронной почты</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="email" required class="form-control" v-model="form.email" placeholder="Адрес электронной почты">
                </div>
                <div v-if="errors.email" class="alert alert-danger mt-2">
                    {{ errors.email }}
                </div>
            </div>

            <div class="form-group">
                <div class="form-group mb-4">
                    <label for="password">Пароль</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon2">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" required placeholder="Пароль" class="form-control" v-model="form.password">
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
            </div>
        </form>
    </div>
</template>

<script>
// Импорт макета
import LayoutAuth from '../../Layouts/Auth.vue';

// Импорт Head из Inertia
import {
    Head
} from '@inertiajs/inertia-vue3';

// Импорт reactive из Vue
import {
    reactive
} from 'vue';

// Импорт Inertia
import {
    Inertia
} from '@inertiajs/inertia';

export default {

    // Макет
    layout: LayoutAuth,

    // Регистрация компонента
    components: {
        Head
    },

    // Props
    props: {
        errors: Object,
        session: Object
    },

    // Определение Composition API
    setup() {

        // Определение состояния формы
        const form = reactive({
            email: '',
            password: '',
        });

        // Метод отправки формы
        const submit = () => {

            // Отправка данных на сервер
            Inertia.post('/login', {

                // Данные
                email: form.email,
                password: form.password,
            });
        }

        // Возврат состояния формы и метода отправки
        return {
            form,
            submit,
        };

    }

}

</script>
