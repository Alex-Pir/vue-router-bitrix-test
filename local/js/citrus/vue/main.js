import Vue from "vue";
import app from './components/app.vue';
import SecondPage from "./components/SecondPage.vue";
import First from "./components/First.vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/test/',
            component: First,
        },
        {
            path: '/test/foo/:id',
            name: 'foo',
            component: SecondPage,
            props: true,
        }
    ]
});

window.SectionAdd = function (properties) {
    return new Vue({
        router,
        render: h => h(app, {
            props: {
                sectionAddData: properties.sectionAddData
            },
        }),

    }).$mount('#app');
}