import axios from 'axios';
import { reducer } from '../store';
const { preloaderOn, preloaderOff, putContactSuccess, putContactError } = reducer.actions;

export default () => (dispatch, state) => {
    const data = state().data.selectedContact
    dispatch(preloaderOn());
    axios.put('http://localhost:8080/contact', data, {
        headers: { Authorization: state().data.authToken },        
    })
        .then(({ data }) => {
            dispatch(putContactSuccess(data))
            dispatch(preloaderOff())
        })
        .catch(({ response }) => {
            dispatch(putContactError(response))
            dispatch(preloaderOff())
        });
};