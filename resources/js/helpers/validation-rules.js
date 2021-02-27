

export default {
    nameRules: [v => !!v || 'Name is required',],
    emailRules: [
        v => (v == null || /.+@.+\..+/.test(v)) || 'E-mail must be valid',
    ],
    categoryRules: [v => !!v || 'Category is required',],
    typeRules: [v => !!v || 'Type is required',],
    passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 5) || 'Password must be qual or more than 5 characters',
    ],
    groupRules: [v => !!v || 'Group is required',],
    slugRules: [
        v => !!v || 'Slug is required',
        v => !!v && v.indexOf('-') === -1 || "Don't use dashes!"
    ],
}
