import axios from 'axios';
import { reducer } from '../store';
const { preloaderOn, preloaderOff, postLoginSuccess, postLoginError } = reducer.actions;

export default () => (dispatch, state) => {
    const data = state().data.loginForm
    dispatch(preloaderOn());
    axios.post('http://localhost:8080/login', data, {
                
    })
        .then(({ data }) => {
            dispatch(postLoginSuccess(data))
            dispatch(preloaderOff())
        })
        .catch(({ response }) => {
            dispatch(postLoginError(response))
            dispatch(preloaderOff())
        });
};