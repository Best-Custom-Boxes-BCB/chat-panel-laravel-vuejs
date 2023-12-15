import {createWebHistory,createRouter} from 'vue-router';


import Visitor from './pages/live-visitor.vue'
import History from './pages/history.vue'

const routes = [
    {
        name:'visitor',
        path:'/admin/visitor',
        component:Visitor
    },
    {
        name:'history',
        path:'/admin/history',
        component:History
    }
];


const router = createRouter({
    history:createWebHistory(),
    routes
});
export default router;
//
