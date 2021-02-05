import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ContactListName from './ContactListName';
import ContactListPhone from './ContactListPhone';

const {  } = reducer.actions;


function ContactList({item}) {
  const dispatch = useDispatch();
  return (
    <div className="ContactList">
        <ContactListName
            item={item}
         />
        <ContactListPhone
            item={item}
         />
    </div>
  );
}

export default ContactList;
