import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;

const langcampaignsHeaderSelector = state => state.data.lang[state.data.activeLang].campaigns.header;

function Campaigns({}) {
  const dispatch = useDispatch();
  const langcampaignsHeader = useSelector(langcampaignsHeaderSelector);
  return (<h1
        >{langcampaignsHeader}</h1>);
}

export default Campaigns;
