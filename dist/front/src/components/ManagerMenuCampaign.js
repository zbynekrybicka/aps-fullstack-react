import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { ManagerMenuCampaignReducer } = reducer.actions;

const MenuCampaignLangSelector = state => state.data.lang[state.data.activeLang].menu.campaign;

function ManagerMenuCampaign({}) {
  const dispatch = useDispatch();
  const MenuCampaignLang = useSelector(MenuCampaignLangSelector);
  return (<button
            className={'blue'}
            onClick={e => dispatch(ManagerMenuCampaignReducer())}
        >{MenuCampaignLang}</button>);
}

export default ManagerMenuCampaign;
