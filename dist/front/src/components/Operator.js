import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ClientData from './ClientData';
import CallHistory from './CallHistory';
import CallScript from './CallScript';

const {  } = reducer.actions;


function Operator({}) {
  const dispatch = useDispatch();
  return (
    <div className="Operator">
        <ClientData
         />
        <CallHistory
         />
        <CallScript
         />
    </div>
  );
}

export default Operator;
