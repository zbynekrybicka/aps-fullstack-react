import { configureStore, createSlice } from '@reduxjs/toolkit';
import initialState from './state';

export const reducer = createSlice({
    name: 'data',
    initialState,
    reducers: {
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
