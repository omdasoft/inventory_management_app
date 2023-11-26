import axios from 'axios';
import { ref } from 'vue';

export default function useProducts() {
    const products = ref({});
    const productDetails = ref({});
    const pagination = ref({});
    const isLoading = ref(false);
    const errorMessage = ref(null);

    const getProducts = async () => {
        isLoading.value = true;
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
                isLoading.value = false;
            });
    }

    const getProduct = async (id) => {
        isLoading.value = true;
        axios
            .get('/products/'+id)
            .then((res) => {
                if (res.data.status == 200) {
                    productDetails.value = res.data.data;
                } else {
                    errorMessage.value = "there is an error occured";
                }
            })
            .catch((err) => {
                errorMessage.value = "there is an error occured";
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    return {
        getProducts,
        products,
        pagination,
        isLoading,
        errorMessage,
        productDetails,
        getProduct
    }
}


