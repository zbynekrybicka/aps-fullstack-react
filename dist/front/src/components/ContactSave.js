import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import putContact from '../actions/putContact.js';

const {  } = reducer.actions;

const SelectedContactSaveLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.save;

function ContactSave({}) {
  const dispatch = useDispatch();
  const SelectedContactSaveLang = useSelector(SelectedContactSaveLangSelector);
  return (<button
            className={'green'}
            onClick={e => dispatch(putContact())}
        >{SelectedContactSaveLang}</button>);
}

export default ContactSave;
