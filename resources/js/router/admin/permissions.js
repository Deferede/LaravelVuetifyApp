import Permissions from "../../components/admin/settings/permissions/Permissions";
import {userGuard} from "../middleware/guards";

export default [
    {
        path: '/admin/settings/permissions',
        name: 'Permissions settings',
        component: Permissions,
        meta: {
            middleware: 'crm.permissions-list'
        },
        beforeEnter: userGuard
    },
]


