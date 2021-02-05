import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ContactCancel from './ContactCancel';
import ContactName from './ContactName';
import ContactPhone from './ContactPhone';
import ContactSave from './ContactSave';

const {  } = reducer.actions;


function ContactDetailContainer({}) {
  const dispatch = useDispatch();
  return (
    <div className="ContactDetailContainer">
        <ContactCancel
         />
        <ContactName
         />
        <ContactPhone
         />
        <ContactSave
         />
    </div>
  );
}

export default ContactDetailContainer;
