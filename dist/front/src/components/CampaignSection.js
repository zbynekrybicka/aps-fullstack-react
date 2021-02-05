import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CampaignListContainer from './CampaignListContainer';
import CampaignDetailContainer from './CampaignDetailContainer';

const {  } = reducer.actions;

const MenuCampaignLangSelector = state => state.data.lang[state.data.activeLang].menu.campaign;
const SelectedCampaignIdSelector = state => state.data.selectedCampaign.id;

function CampaignSection({}) {
  const dispatch = useDispatch();
  const MenuCampaignLang = useSelector(MenuCampaignLangSelector);
  const SelectedCampaignId = useSelector(SelectedCampaignIdSelector);
  return (
    <div className="CampaignSection">
        <h1
        >{MenuCampaignLang}</h1>
        {!SelectedCampaignId && <CampaignListContainer
        />}
        {SelectedCampaignId && <CampaignDetailContainer
        />}
    </div>
  );
}

export default CampaignSection;
