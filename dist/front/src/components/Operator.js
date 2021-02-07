import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;

const langoperatorHeaderSelector = state => state.data.lang[state.data.activeLang].operator.header;

function Operator({}) {
  const dispatch = useDispatch();
  const langoperatorHeader = useSelector(langoperatorHeaderSelector);
  return (<h1
        >{langoperatorHeader}</h1>);
}

export default Operator;
