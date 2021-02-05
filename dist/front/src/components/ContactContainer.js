import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ContactList from './ContactList';


const { selectContact } = reducer.actions;


function ContactContainer({item}) {
  const dispatch = useDispatch();
  return (<div
            className={'list-row'}
            onClick={e => dispatch(selectContact(item))}
        >{<ContactList item={item} />}</div>);
}

export default ContactContainer;
