import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setlangSelectedContactEmail } = reducer.actions;

const langSelectedContactEmailSelector = state => state.data.selectedContact.email;
const SelectedContactEmailLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.email;

function ContactEmail({}) {
  const dispatch = useDispatch();
  const langSelectedContactEmail = useSelector(langSelectedContactEmailSelector);
  const SelectedContactEmailLang = useSelector(SelectedContactEmailLangSelector);
  return (<input
            type={'text'}
            defaultValue={langSelectedContactEmail}
            onInput={e => dispatch(setlangSelectedContactEmail(e.target.value))}
            placeholder={SelectedContactEmailLang}
         />);
}

export default ContactEmail;
