import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;


function App({}) {
  const dispatch = useDispatch();
  return (<h1
        >{'Hello world!!!'}</h1>);
}

export default App;

