import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { contacts, campaigns, calls } = reducer.actions;

const langmenuContactsSelector = state => state.data.lang[state.data.activeLang].menu.contacts;
const langmenuCampaignsSelector = state => state.data.lang[state.data.activeLang].menu.campaigns;
const langmenuCallsSelector = state => state.data.lang[state.data.activeLang].menu.calls;

function Menu({}) {
  const dispatch = useDispatch();
  const langmenuContacts = useSelector(langmenuContactsSelector);
  const langmenuCampaigns = useSelector(langmenuCampaignsSelector);
  const langmenuCalls = useSelector(langmenuCallsSelector);
  return (
    <div className="Menu">
        <button
            onClick={() => dispatch(contacts())}
        >{langmenuContacts}</button>
        <button
            onClick={() => dispatch(campaigns())}
        >{langmenuCampaigns}</button>
        <button
            onClick={() => dispatch(calls())}
        >{langmenuCalls}</button>
    </div>
  );
}

export default Menu;
