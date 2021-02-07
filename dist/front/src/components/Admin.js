import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Operator from './Operator';
import Manager from './Manager';

const {  } = reducer.actions;

const isOperatorSelector = state => state.data.appData.operator;
const isManagerSelector = state => state.data.appData.manager;

function Admin({}) {
  const dispatch = useDispatch();
  const isOperator = useSelector(isOperatorSelector);
  const isManager = useSelector(isManagerSelector);
  return (
    <div className="Admin">
        {(!!isOperator) && <Operator/>}
        {(!!isManager) && <Manager/>}
    </div>
  );
}

export default Admin;
