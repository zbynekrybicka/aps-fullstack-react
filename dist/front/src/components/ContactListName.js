import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;


function ContactListName({item}) {
  const dispatch = useDispatch();
  return (<div
            className={'list-cell'}
        >{item.name}</div>);
}

export default ContactListName;
