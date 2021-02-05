import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;


function ContactListPhone({item}) {
  const dispatch = useDispatch();
  return (<div
            className={'list-cell'}
        >{item.phone}</div>);
}

export default ContactListPhone;
