import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setlangSelectedContactPhone } = reducer.actions;

const langSelectedContactPhoneSelector = state => state.data.selectedContact.phone;
const SelectedContactPhoneLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.phone;

function ContactPhone({}) {
  const dispatch = useDispatch();
  const langSelectedContactPhone = useSelector(langSelectedContactPhoneSelector);
  const SelectedContactPhoneLang = useSelector(SelectedContactPhoneLangSelector);
  return (<input
            type={'text'}
            defaultValue={langSelectedContactPhone}
            onInput={e => dispatch(setlangSelectedContactPhone(e.target.value))}
            placeholder={SelectedContactPhoneLang}
         />);
}

export default ContactPhone;
