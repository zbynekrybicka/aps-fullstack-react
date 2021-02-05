import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ContactListContainer from './ContactListContainer';
import ContactDetailContainer from './ContactDetailContainer';

const {  } = reducer.actions;

const MenuContactLangSelector = state => state.data.lang[state.data.activeLang].menu.contact;
const SelectedContactIdSelector = state => state.data.selectedContact.id;

function ContactSection({}) {
  const dispatch = useDispatch();
  const MenuContactLang = useSelector(MenuContactLangSelector);
  const SelectedContactId = useSelector(SelectedContactIdSelector);
  return (
    <div className="ContactSection">
        <h1
        >{MenuContactLang}</h1>
        {!SelectedContactId && <ContactListContainer
        />}
        {SelectedContactId && <ContactDetailContainer
        />}
    </div>
  );
}

export default ContactSection;
