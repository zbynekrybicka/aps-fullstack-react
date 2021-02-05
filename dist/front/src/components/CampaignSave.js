import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import putCampaign from '../actions/putCampaign.js';

const {  } = reducer.actions;

const SelectedCampaignSaveLangSelector = state => state.data.lang[state.data.activeLang].selectedCampaign.save;

function CampaignSave({}) {
  const dispatch = useDispatch();
  const SelectedCampaignSaveLang = useSelector(SelectedCampaignSaveLangSelector);
  return (<button
            className={'green'}
            onClick={e => dispatch(putCampaign())}
        >{SelectedCampaignSaveLang}</button>);
}

export default CampaignSave;
