import {userGuard} from "../middleware/guards";

import Roles from "../../components/admin/settings/roles/Roles";

export default [
    {
        path: '/admin/settings/roles',
        name: 'Roles settings',
        component: Roles,
        meta: {
            middleware: 'crm.roles-list'
        },
        beforeEnter: userGuard
    }
]


