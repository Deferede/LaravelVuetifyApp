import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../components/Home'
import Login from '../components/auth/Login'
import Leads from '../components/crm/Leads'
import Lead from '../components/crm/Lead'
import Me from '../components/user/Me'
import NewLead from '../components/crm/NewLead'
import admin_settings_permissions from "./admin/permissions"
import admin_settings_roles from "./admin/roles"
import statuses from "./admin/statuses"
import Users from "../components/admin/settings/users/Users"

import {userGuard, guestGuard} from "./middleware/guards"
import Forbidden from "../components/Forbidden"

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        ...admin_settings_permissions,
        ...admin_settings_roles,
        ...statuses,
        {
            path: '/',
            name: 'Home',
            component: Home,
            beforeEnter: userGuard
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEnter: guestGuard
        },
        {
            path: '/admin/settings/users',
            name: 'Users',
            component: Users,
            meta:{
                middleware: 'crm.users-list'
            },
            beforeEnter: userGuard,
        },
        // {
        //     path: '/registration',
        //     name: 'Registration',
        //     component: Registration,
        //     meta: {
        //         middleware: [
        //             guest
        //         ]
        //     }
        // },
        {
            path: '/leads/all',
            name: 'All leads',
            component: Leads,
            meta: {
                middleware: [

                ]
            },
            beforeEnter: userGuard
        },
        {
            path: '/leads/new',
            name: 'New lead',
            component: NewLead,
            meta: {
                middleware: [

                ]
            }
        },
        {
            path: '/leads/view/:id',
            name: 'Lead',
            component: Lead,
            props: true,
            beforeEnter: userGuard

        },
        {
            path: '/me',
            name: 'Me',
            component: Me,
            meta: [],
            beforeEnter: userGuard
        },
        {
            path: '/403',
            name: 'Forbidden',
            component: Forbidden,
        },
        {
            path: '*',
            redirect: '/'
        }

    ],
    mode: 'history',
})

export default router
