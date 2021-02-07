import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setContactscontactsSearch } = reducer.actions;

const langcontactsHeaderSelector = state => state.data.lang[state.data.activeLang].contacts.header;
const langcontactsContactsSearchSelector = state => state.data.lang[state.data.activeLang].contacts.ContactsSearch;
const contactscontactsSearchSelector = state => state.data.contacts.contactsSearch;

function Contacts({}) {
  const dispatch = useDispatch();
  const langcontactsHeader = useSelector(langcontactsHeaderSelector);
  const langcontactsContactsSearch = useSelector(langcontactsContactsSearchSelector);
  const contactscontactsSearch = useSelector(contactscontactsSearchSelector);
  return (
    <div className="Contacts">
        <h1>{langcontactsHeader}</h1>
        <input
            type={'text'}
            placeholder={langcontactsContactsSearch}
            defaultValue={contactscontactsSearch}
            onInput={e => dispatch(setContactscontactsSearch(e.target.value))}
         />
    </div>
  );
}

export default Contacts;
