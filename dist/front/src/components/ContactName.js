import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setlangSelectedContactName } = reducer.actions;

const langSelectedContactNameSelector = state => state.data.selectedContact.name;
const SelectedContactNameLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.name;

function ContactName({}) {
  const dispatch = useDispatch();
  const langSelectedContactName = useSelector(langSelectedContactNameSelector);
  const SelectedContactNameLang = useSelector(SelectedContactNameLangSelector);
  return (<input
            type={'text'}
            defaultValue={langSelectedContactName}
            onInput={e => dispatch(setlangSelectedContactName(e.target.value))}
            placeholder={SelectedContactNameLang}
         />);
}

export default ContactName;
