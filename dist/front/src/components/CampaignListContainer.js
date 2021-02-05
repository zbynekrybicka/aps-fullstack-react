import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Campaign from './Campaign';

const {  } = reducer.actions;


function CampaignListContainer({}) {
  const dispatch = useDispatch();
  return (<Campaign
         />);
}

export default CampaignListContainer;
