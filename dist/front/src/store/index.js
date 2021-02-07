import { configureStore, createSlice } from '@reduxjs/toolkit';
import initialState from './state';

export const reducer = createSlice({
    name: 'data',
    initialState,
    reducers: {
    },
});

export default configureStore({
    reducer: {
        data: reducer.reducer
    }
});
