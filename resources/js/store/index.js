import Vue from 'vue'
import Vuex from 'vuex'
import leads from './modules/leads';
import user from './modules/user'
import shared from "./modules/shared";
import statuses from "./modules/admin/statuses/statuses";
import statusTypes from "./modules/admin/statuses/types";
import statusCategories from "./modules/admin/statuses/categories";
import users from "./modules/admin/users";
import roles from "./modules/admin/roles";
import permissions from "./modules/admin/permissions";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        leads,
        user,
        shared,
        users,
        roles,
        permissions,
        statuses,
        statusTypes,
        statusCategories
    }
})
