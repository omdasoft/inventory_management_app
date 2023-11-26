import axios from 'axios';
import { ref } from 'vue';

export default function useCategories() {
    const categories = ref({});

    const getCategories = async () => {
        axios.get('/categories')
        .then((res) => {
            console.log(res.data.data);
            categories.value = res.data.data;
        })
        .catch(err => {
            console.log(err.data);
        });
    }

    return {
        getCategories,
        categories
    }
}