import Dashboard from './components/Dashboard.vue';
import ProductList from './pages/products/ProductList.vue';
import ProductView from './pages/products/ProductView.vue';

import Login from './pages/auth/Login.vue';

export default [
    {
        path: '/login',
        name: 'admin.login',
        component: Login
    },
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard
    },
    {
        path: '/admin/products',
        name: 'admin.products',
        component: ProductList
    },
    {
        path: '/product/view/:id',
        name: 'product.details',
        component: ProductView
    }
]