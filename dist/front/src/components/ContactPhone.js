import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { setSelectedContactPhone } = reducer.actions;

const SelectedContactPhoneSelector = state => state.data.selectedContact.phone;
const SelectedContactPhoneLangSelector = state => state.data.lang[state.data.activeLang].selectedContact.phone;

function ContactPhone({}) {
  const dispatch = useDispatch();
  const SelectedContactPhone = useSelector(SelectedContactPhoneSelector);
  const SelectedContactPhoneLang = useSelector(SelectedContactPhoneLangSelector);
  return (<input
            type={'text'}
            defaultValue={SelectedContactPhone}
            onInput={e => dispatch(setSelectedContactPhone(e.target.value))}
            placeholder={SelectedContactPhoneLang}
         />);
}

export default ContactPhone;
