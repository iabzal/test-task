<template>

    <main v-if="$page.props.auth.client">
        <Navbar/>
        <div class="container">
            <div class="my-5">
                <slot />
            </div>
        </div>

    </main>


    <div class="container" v-else>
        <slot />
    </div>

</template>

<script>

import Navbar from "../Components/Client/Navbar.vue";

export default {
    components: {
        Navbar
    },
}
</script>

