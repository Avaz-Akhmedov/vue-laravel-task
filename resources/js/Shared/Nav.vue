<template>
    <header class="header">
        <Link href="/" class="btn">Мои продукти</Link>
        <Link href="/products" class="btn">Создать новый продукт</Link>
    </header>
</template>


<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {Link}
}
</script>
