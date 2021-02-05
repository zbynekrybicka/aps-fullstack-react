import { configureStore, createSlice } from '@reduxjs/toolkit';
import initialState from './state';

export const reducer = createSlice({
    name: 'data',
    initialState,
    reducers: {
        CzLangReducer: (state, action) => {
            state.activeLang = 0
        },
        EnLangReducer: (state, action) => {
            state.activeLang = 1
        },
        setLoginFormUsername: (state, action) => {
            state.loginForm.username = action.payload
        },
        setLoginFormPassword: (state, action) => {
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
        setSelectedContactName: (state, action) => {
            state.selectedContact.name = action.payload
        },
        setSelectedContactPhone: (state, action) => {
            state.selectedContact.phone = action.payload
        },
        setSelectedContactEmail: (state, action) => {
            state.selectedContact.email = action.payload
        },
        putContactSuccess: (state, action) => {
            state.appData.manager.contact[state.appData.manager.contact.findIndex(item => state.selectedContact.id === item.id)] = Object.assign({}, state.selectedContact)
            state.selectedContact.id = null
        },
        putContactError: (state, action) => {
        },
        selectCampaign: (state, action) => {
            state.selectedCampaign = action.payload
        },
        CampaignCancelReducer: (state, action) => {
            state.selectedCampaign.id = null
        },
        setSelectedCampaignName: (state, action) => {
            state.selectedCampaign.name = action.payload
        },
        putCampaignSuccess: (state, action) => {
            state.appData.manager.campaign[state.appData.manager.campaign.findIndex(item => state.selectedCampaign.id === item.id)] = Object.assign({}, state.selectedCampaign)
            state.selectedCampaign.id = null
        },
        putCampaignError: (state, action) => {
        },
    },
});

export default configureStore({
    reducer: {
        data: reducer.reducer
    }
});
