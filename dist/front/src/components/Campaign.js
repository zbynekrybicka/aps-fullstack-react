import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CampaignContainer from './CampaignContainer';


const {  } = reducer.actions;

const AppDataManagerCampaignMapSelector = state => state.data.appData.manager.campaign;

function Campaign({}) {
  const dispatch = useDispatch();
  const AppDataManagerCampaignMap = useSelector(AppDataManagerCampaignMapSelector);
  return (<div
            className={'list'}
        >{AppDataManagerCampaignMap.map((item, i) => <CampaignContainer key={'Campaign' + i} item={item} />)}</div>);
}

export default Campaign;
