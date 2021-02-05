import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { switchLangEn } = reducer.actions;

const LangsEnLangSelector = state => state.data.lang[state.data.activeLang].langs.en;

function EnLang({}) {
  const dispatch = useDispatch();
  const LangsEnLang = useSelector(LangsEnLangSelector);
  return (<button
            className={'grey'}
            onClick={e => dispatch(switchLangEn())}
        >{LangsEnLang}</button>);
}

export default EnLang;
