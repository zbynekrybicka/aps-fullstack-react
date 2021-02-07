import axios from 'axios';
import { reducer } from '../store';
const { preloaderOn, preloaderOff, postLoginSuccess, postLoginFail } = reducer.actions;

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
            dispatch(postLoginFail(response))
            dispatch(preloaderOff())
        });
};