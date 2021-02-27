import Statuses from "../../components/admin/settings/statuses/Statuses";
import Status from "../../components/admin/settings/statuses/Status";
import NewStatus from "../../components/admin/settings/statuses/NewStatus";
import auth from "../middleware/auth";
import admin from "../middleware/admin";
import EditStatus from "../../components/admin/settings/statuses/EditStatus";

export default [
    {
        path: '/admin/settings/statuses',
        name: 'Status settings',
        component: Statuses,
        meta: {
            middleware: [
                auth,
                admin
            ]
        },
    },
    {
        path: '/admin/settings/statuses/new',
        name: 'Create status',
        component: NewStatus,
        meta: {
            middleware: [
                auth,
                admin
            ]
        },
    },
    {
        path: '/admin/settings/statuses/edit/:id',
        name: 'Edit status',
        props: true,
        component: EditStatus,
        meta: {
            middleware: [
                auth,
                admin
            ]
        },
    },
    {
        path: '/admin/settings/statuses/:id',
        name: 'Status view',
        props: true,
        component: Status,
        meta: {
            middleware: [
                auth,
                admin
            ]
        },
    }
]


