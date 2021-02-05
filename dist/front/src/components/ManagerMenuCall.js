import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { ManagerMenuCallReducer } = reducer.actions;

const MenuCallLangSelector = state => state.data.lang[state.data.activeLang].menu.call;

function ManagerMenuCall({}) {
  const dispatch = useDispatch();
  const MenuCallLang = useSelector(MenuCallLangSelector);
  return (<button
            className={'green'}
            onClick={e => dispatch(ManagerMenuCallReducer())}
        >{MenuCallLang}</button>);
}

export default ManagerMenuCall;
