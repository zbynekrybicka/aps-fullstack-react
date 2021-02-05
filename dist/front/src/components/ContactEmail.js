import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setSelectedContactEmail } = reducer.actions;

const SelectedContactEmailSelector = state => state.data.selectedContact.email;
const SelectedContactEmailLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.email;

function ContactEmail({}) {
  const dispatch = useDispatch();
  const SelectedContactEmail = useSelector(SelectedContactEmailSelector);
  const SelectedContactEmailLang = useSelector(SelectedContactEmailLangSelector);
  return (<input
            type={'text'}
            defaultValue={SelectedContactEmail}
            onInput={e => dispatch(setSelectedContactEmail(e.target.value))}
            placeholder={SelectedContactEmailLang}
         />);
}

export default ContactEmail;
