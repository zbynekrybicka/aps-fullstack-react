import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setSelectedContactName } = reducer.actions;

const SelectedContactNameSelector = state => state.data.selectedContact.name;
const SelectedContactNameLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.name;

function ContactName({}) {
  const dispatch = useDispatch();
  const SelectedContactName = useSelector(SelectedContactNameSelector);
  const SelectedContactNameLang = useSelector(SelectedContactNameLangSelector);
  return (<input
            type={'text'}
            defaultValue={SelectedContactName}
            onInput={e => dispatch(setSelectedContactName(e.target.value))}
            placeholder={SelectedContactNameLang}
         />);
}

export default ContactName;
