import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { ManagerMenuContactReducer } = reducer.actions;

const MenuContactLangSelector = state => state.data.lang[state.data.activeLang].menu.contact;

function ManagerMenuContact({}) {
  const dispatch = useDispatch();
  const MenuContactLang = useSelector(MenuContactLangSelector);
  return (<button
            className={'green'}
            onClick={e => dispatch(ManagerMenuContactReducer())}
        >{MenuContactLang}</button>);
}

export default ManagerMenuContact;
