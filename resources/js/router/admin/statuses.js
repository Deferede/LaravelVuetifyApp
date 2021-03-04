import {userGuard} from "../middleware/guards";
import Statuses from "../../components/admin/settings/statuses/Statuses";
import Types from "../../components/admin/settings/statuses/Types";
import Categories from "../../components/admin/settings/statuses/Categories";

export default [
    {
        path: '/admin/settings/statuses',
        name: 'Status settings',
        component: Statuses,
        meta: {
            middleware: [
                'crm.statuses-list'
            ]
        },
        beforeEnter: userGuard
    },
    {
        path: '/admin/settings/statuses/types',
        name: 'Status-type settings',
        component: Types,
        meta: {
            middleware: [
                'crm.status_types-list'
            ]
        },
        beforeEnter: userGuard
    },
    {
        path: '/admin/settings/statuses/categories',
        name: 'Status-category settings',
        component: Categories,
        meta: {
            middleware: [
                'crm.status_categories-list'
            ]
        },
        beforeEnter: userGuard
    },
]


