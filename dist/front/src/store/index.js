import { configureStore, createSlice } from '@reduxjs/toolkit';
import initialState from './state';

export const reducer = createSlice({
    name: 'data',
    initialState,
    reducers: {
        preloaderOn: (state) => {
            state.preloader = true
        },
        preloaderOff: (state) => {
            state.preloader = false
        },
        setUsername: (state, action) => {
             state.loginForm.username = action.payload
        },
        setPassword: (state, action) => {
             state.loginForm.password = action.payload
        },
        postLoginSuccess: (state, action) => {
            state.authToken = action.payload.authToken
        },
        postLoginError: (state, action) => {
            state.errorMessage = 'Přihlášení nebylo úspěšné. Zkontrolujte přihlašovací údaje.'
        },
    },
});

export default configureStore({
    reducer: {
        data: reducer.reducer
    }
});
