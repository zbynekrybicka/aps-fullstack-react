import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CampaignListName from './CampaignListName';

const {  } = reducer.actions;


function CampaignList({item}) {
  const dispatch = useDispatch();
  return (<CampaignListName
            item={item}
         />);
}

export default CampaignList;
