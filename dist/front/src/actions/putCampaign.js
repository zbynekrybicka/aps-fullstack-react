import axios from 'axios';
import { reducer } from '../store';
const { preloaderOn, preloaderOff, putCampaignSuccess, putCampaignError } = reducer.actions;

export default () => (dispatch, state) => {
    const data = state().data.selectedCampaign
    dispatch(preloaderOn());
    axios.put('http://localhost:8080/campaign', data, {
        headers: { Authorization: state().data.authToken },        
    })
        .then(({ data }) => {
            dispatch(putCampaignSuccess(data))
            dispatch(preloaderOff())
        })
        .catch(({ response }) => {
            dispatch(putCampaignError(response))
            dispatch(preloaderOff())
        });
};