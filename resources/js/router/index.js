import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/auth/Login.vue';
import AdminDashboard from '../components/admin/Dashboard.vue';
import UserDashboard from '../components/user/Dashboard.vue';

const routes = [
    { path: '/login', component: Login },
    { path: '/admin', component: AdminDashboard, meta: { role: 'admin' } },
    { path: '/account', component: UserDashboard, meta: { role: 'user' } },
];

const router = createRouter({ history: createWebHistory(), routes });

router.beforeEach((to, from, next) => {
    const roles = JSON.parse(localStorage.getItem('roles') || '[]');
    if (to.meta.role && !roles.includes(to.meta.role)) {
        return next('/login');
    }
    next();
});

export default router;
