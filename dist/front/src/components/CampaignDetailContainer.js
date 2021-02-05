import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CampaignCancel from './CampaignCancel';
import CampaignName from './CampaignName';
import CampaignSave from './CampaignSave';

const {  } = reducer.actions;


function CampaignDetailContainer({}) {
  const dispatch = useDispatch();
  return (
    <div className="CampaignDetailContainer">
        <CampaignCancel
         />
        <CampaignName
         />
        <CampaignSave
         />
    </div>
  );
}

export default CampaignDetailContainer;
