import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { ContactCancelReducer } = reducer.actions;

const SelectedContactCancelLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.cancel;

function ContactCancel({}) {
  const dispatch = useDispatch();
  const SelectedContactCancelLang = useSelector(SelectedContactCancelLangSelector);
  return (<button
            className={'grey'}
            onClick={e => dispatch(ContactCancelReducer())}
        >{SelectedContactCancelLang}</button>);
}

export default ContactCancel;
