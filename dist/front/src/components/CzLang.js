import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { switchLangCz } = reducer.actions;

const LangsCzLangSelector = state => state.data.lang[state.data.activeLang].langs.cz;

function CzLang({}) {
  const dispatch = useDispatch();
  const LangsCzLang = useSelector(LangsCzLangSelector);
  return (<button
            className={'grey'}
            onClick={e => dispatch(switchLangCz())}
        >{LangsCzLang}</button>);
}

export default CzLang;
