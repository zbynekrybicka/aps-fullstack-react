import axios from 'axios';
import { reducer } from '../store';
const {
    preloaderOn,
    preloaderOff,
    pingSuccess,
    pingError
} = reducer.actions;

export default () => (dispatch, state) => {

    dispatch(preloaderOn());
    axios.get('http://localhost:8081/ping',
        {
                
    })
        .then(({ data }) => {
            dispatch(pingSuccess(data))
            dispatch(preloaderOff())
        })
        .catch(({ response }) => {
            dispatch(pingError(response))
            dispatch(preloaderOff())
        });
};
