<template>
    <div>
        <Nav/>
        <div class="container">
            <p class="title">Мои товари</p>
            <table class="table">
                <thead>
                <tr>
                    <th>Название товара</th>
                    <th>Количество</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(product, index) in products" :key="index">
                    <td class="table-input">
                        {{ product.name }}
                    </td>
                    <td class="table-input">
                        {{ product.count }}
                    </td>
                    <td class="table-input">
                        {{ product.price }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Nav from "@/Shared/Nav.vue";

export default {
    components: {
        Nav
    },
    props: {
        products: Array,
    },
};

</script>
