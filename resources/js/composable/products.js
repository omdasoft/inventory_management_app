import axios from 'axios';
import { ref } from 'vue';

export default function useProducts() {
    const products = ref({});
    const pagination = ref({});
    const loading = ref(false);
    const errorMessage = ref(null);

    const getProducts = () => {
        loading.value = true;
        axios
            .get('/products')
            .then((res) => {
                if (res.data.status == 200) {
                    products.value = res.data.data;
                    pagination.value = res.data.pagination;
                } else {
                    errorMessage.value = "there is an error occured";
                }
            })
            .catch(err => {
                if (err.response) {
                    errorMessage.value = "there is an error occured";
                }
            })
            .finally(() => {
                loading.value = false;
            });
    }

    return {
        getProducts,
        products,
        pagination,
        loading,
        errorMessage
    }
}


