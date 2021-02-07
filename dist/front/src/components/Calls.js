import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;

const langcallsHeaderSelector = state => state.data.lang[state.data.activeLang].calls.header;

function Calls({}) {
  const dispatch = useDispatch();
  const langcallsHeader = useSelector(langcallsHeaderSelector);
  return (<h1
        >{langcallsHeader}</h1>);
}

export default Calls;
