import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;


function CampaignSection({}) {
  const dispatch = useDispatch();
  return (<div
        >{'Kampaň'}</div>);
}

export default CampaignSection;
