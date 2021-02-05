import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { CampaignCancelReducer } = reducer.actions;

const SelectedCampaignCancelLangSelector = state => state.data.lang[state.data.activeLang].selectedCampaign.cancel;

function CampaignCancel({}) {
  const dispatch = useDispatch();
  const SelectedCampaignCancelLang = useSelector(SelectedCampaignCancelLangSelector);
  return (<button
            className={'grey'}
            onClick={e => dispatch(CampaignCancelReducer())}
        >{SelectedCampaignCancelLang}</button>);
}

export default CampaignCancel;
