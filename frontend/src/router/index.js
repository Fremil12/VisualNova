import { createRouter, createWebHistory } from "vue-router";
import Game from "../components/Game.vue";
import AboutUser from "../components/AboutUser.vue";
import ProfileSettings from "../components/ProfileSettings.vue";

const routes = [
    {
        path:"/game",
        component:Game,
    },
    {
        path:"/AboutUser",
        component:AboutUser,
    },
    {
        path:"/ProfileSettings",
        component:ProfileSettings,
    },
];

const router = createRouter({
    history:createWebHistory(process.env.BASE_URL),
    routes,
});
