import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setSelectedCampaignName } = reducer.actions;

const SelectedCampaignNameSelector = state => state.data.selectedCampaign.name;
const SelectedCampaignNameLangSelector = state => state.data.lang[state.data.activeLang].selectedCampaign.name;

function CampaignName({}) {
  const dispatch = useDispatch();
  const SelectedCampaignName = useSelector(SelectedCampaignNameSelector);
  const SelectedCampaignNameLang = useSelector(SelectedCampaignNameLangSelector);
  return (<input
            type={'text'}
            defaultValue={SelectedCampaignName}
            onInput={e => dispatch(setSelectedCampaignName(e.target.value))}
            placeholder={SelectedCampaignNameLang}
         />);
}

export default CampaignName;
