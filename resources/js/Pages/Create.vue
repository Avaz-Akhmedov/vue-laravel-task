<template>
    <div>

        <Nav/>
        <div class="title__container">
            <p class="title__text">Новая закупка</p>
        </div>

        <div class="container">
            <p class="title">Товарные позиции</p>

            <p v-if="successMessage" class="title success-message">
                {{ successMessage }}
                <button  @click="removeSuccessMessage">X</button>
            </p>

            <table class="table">
                <thead>
                <tr>
                    <th>Название товара</th>
                    <th>Количество</th>
                    <th>Список закупок(%)</th>
                </tr>
                </thead>
                <tbody v-if="showInputs">
                <tr v-for="(product, index) in products" :key="index">
                    <td class="table-input">
                        <input v-model="product.name" placeholder="Product Name" />
                    </td>
                    <td class="table-input">
                        <input required type="number" v-model="product.count" placeholder="Count" />
                    </td>
                    <td class="table-input">
                        <input required type="number" v-model="product.price" placeholder="Price" step="0.01" />
                        <button @click="removeProduct(index)">Remove</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <button @click="addProduct" class="plus">+ Добавить</button>

            <div class="buttons">
                <button class="btn-сancel">Отмена</button>
                <button @click="saveProducts" class="btn-submit">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import {Link} from "@inertiajs/inertia-vue3";
import Nav from "@/Shared/Nav.vue";
export default {
    components: {Nav},
    props: {
        success: String,
    },

    setup(props) {
        const products = ref([]);
        const errors = ref([]);
        const showInputs = ref(false);
        const successMessage = ref(props.success);

        const addProduct = () => {
            if (!showInputs.value) {
                showInputs.value = true;
            }
            products.value.push({name: '', count: 0, price: 0.0});
        };

        const removeProduct = (index) => {
            products.value.splice(index, 1);
            if (products.value.length === 0) {
                showInputs.value = false;
            }
        };

        const clearErrors = () => {
            errors.value = [];
        };

        const saveProducts = async () => {
            errors.value = [];
            try {
                await Inertia.post('/products/store', {products: products.value});
                products.value = [];
                showInputs.value = false;
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = Object.values(error.response.data.errors).flat();
                } else {
                    console.error("An unexpected error occurred:", error);
                }
            }
        };

        const removeSuccessMessage = () => {
            successMessage.value = null;
        };

        watch(() => props.success, (newVal) => {
            successMessage.value = newVal;
        });

        return {
            products,
            addProduct,
            removeProduct,
            saveProducts,
            errors,
            showInputs,
            clearErrors,
            successMessage,
            removeSuccessMessage,
            Link,
        };
    },
};
</script>
