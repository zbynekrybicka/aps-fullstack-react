import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CampaignList from './CampaignList';


const { selectCampaign } = reducer.actions;


function CampaignContainer({item}) {
  const dispatch = useDispatch();
  return (<div
            className={'list-row'}
            onClick={e => dispatch(selectCampaign(item))}
        >{<CampaignList item={item} />}</div>);
}

export default CampaignContainer;
