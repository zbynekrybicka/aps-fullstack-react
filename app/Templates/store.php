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
<?php foreach ($reducers as $reducer) { ?>
        <?=$reducer->title; ?>: (state, action) => {
<?php foreach ($reducer->content as $line) { ?>
            <?=$line; ?>

<?php } ?>
        },
<?php } ?>
    },
});

export default configureStore({
    reducer: {
        data: reducer.reducer
    }
});
