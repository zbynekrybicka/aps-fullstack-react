import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;


function CampaignListName({item}) {
  const dispatch = useDispatch();
  return (<div
            className={'list-cell'}
        >{item.name}</div>);
}

export default CampaignListName;
