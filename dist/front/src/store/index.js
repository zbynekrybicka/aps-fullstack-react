import { configureStore, createSlice } from '@reduxjs/toolkit';
import initialState from './state';

export const reducer = createSlice({
    name: 'data',
    initialState,
    reducers: {
        switchLangCz: (state, action) => {
            state.activeLang = 0
        },
        switchLangEn: (state, action) => {
            state.activeLang = 1
        },
        setlangLoginFormUsername: (state, action) => {
            state.loginForm.username = action.payload
        },
        setlangLoginFormPassword: (state, action) => {
            state.loginForm.password = action.payload
        },
        preloaderOn: (state, action) => {
            state.preloader = true
        },
        preloaderOff: (state, action) => {
            state.preloader = false
        },
        postLoginSuccess: (state, action) => {
            state.authToken = action.payload.authToken
            state.user = action.payload.user
            state.appData = action.payload.appData
        },
        postLoginError: (state, action) => {
            state.errorMessage = action.payload
        },
        ManagerMenuContactReducer: (state, action) => {
            state.section = 0
        },
        ManagerMenuCampaignReducer: (state, action) => {
            state.section = 1
        },
        ManagerMenuCallReducer: (state, action) => {
            state.section = 2
        },
        selectContact: (state, action) => {
            state.selectedContact = action.payload
        },
        ContactCancelReducer: (state, action) => {
            state.selectedContact.id = null
        },
        setlangSelectedContactName: (state, action) => {
            state.selectedContact.name = action.payload
        },
        setlangSelectedContactPhone: (state, action) => {
            state.selectedContact.phone = action.payload
        },
        setlangSelectedContactEmail: (state, action) => {
            state.selectedContact.email = action.payload
        },
        putContactSuccess: (state, action) => {
            state.appData.manager.contact[state.appData.manager.contact.findIndex(item => state.selectedContact.id === item.id)] = Object.assign({}, state.selectedContact)
            state.selectedContact.id = null
        },
        putContactError: (state, action) => {
        },
    },
});

export default configureStore({
    reducer: {
        data: reducer.reducer
    }
});
