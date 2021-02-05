import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;

const AppDataOperatorCallClientNameSelector = state => state.data.appData.operator.call.client.name;
const AppDataOperatorCallClientPhoneSelector = state => state.data.appData.operator.call.client.phone;
const AppDataOperatorClientPhoneSelector = state => state.data.appData.operator.client.phone;

function ClientData({}) {
  const dispatch = useDispatch();
  const AppDataOperatorCallClientName = useSelector(AppDataOperatorCallClientNameSelector);
  const AppDataOperatorCallClientPhone = useSelector(AppDataOperatorCallClientPhoneSelector);
  const AppDataOperatorClientPhone = useSelector(AppDataOperatorClientPhoneSelector);
  return (
    <div className="ClientData">
        <div
        >{AppDataOperatorCallClientName}</div>
        <a
            href={'tel:' + AppDataOperatorCallClientPhone}
        >{AppDataOperatorClientPhone}</a>
    </div>
  );
}

export default ClientData;
