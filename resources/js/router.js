import { createWebHistory, createRouter } from "vue-router";
const Error = () => import('./components/Error.vue');
const CategoryView = () => import('./components/views/CategoryView.vue');
const TagView = () => import('./components/views/TagView.vue');
const AuthorView = () => import('./components/views/AuthorView.vue');
const MainView = () => import('./components/views/MainView.vue');
const StaticView = () => import('./components/views/StaticView.vue');
const NewsItemView = () => import('./components/views/NewsItemView.vue');
const NewsItemPreview = () => import('./components/views/NewsItemPreview.vue');
const TemplateItemPreview = () => import('./components/views/TemplateItemPreview.vue');

const routes = [
    { 
        name: '404',
        path: '/:pathMatch(.*)*', 
        component: Error 
    },
    { 
        name: 'mainView',
        path: '/', 
        component: MainView 
    },
    { 
        name: 'staticView',
        path: '/:uri', 
        component: StaticView 
    },
    { 
        name: 'categoryView',
        path: '/category/:uri', 
        component: CategoryView 
    },
    { 
        name: 'tagView',
        path: '/tag/:uri', 
        component: TagView 
    },
    { 
        name: 'authorView',
        path: '/author/:uri', 
        component: AuthorView 
    },
    { 
        name: 'newsItemView',
        path: '/news/:uri', 
        component: NewsItemView 
    },
    { 
        name: 'newsItemPreview',
        path: '/preview/:id/:key', 
        component: NewsItemPreview 
    },
    { 
        name: 'templateItemPreview',
        path: '/template/:id/:key', 
        component: TemplateItemPreview 
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;