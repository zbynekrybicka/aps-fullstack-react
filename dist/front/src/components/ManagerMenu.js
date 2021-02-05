import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ManagerMenuContact from './ManagerMenuContact';
import ManagerMenuCampaign from './ManagerMenuCampaign';
import ManagerMenuCall from './ManagerMenuCall';

const {  } = reducer.actions;


function ManagerMenu({}) {
  const dispatch = useDispatch();
  return (
    <div className="ManagerMenu">
        <ManagerMenuContact
         />
        <ManagerMenuCampaign
         />
        <ManagerMenuCall
         />
    </div>
  );
}

export default ManagerMenu;
