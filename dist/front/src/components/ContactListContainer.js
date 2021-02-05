import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Contact from './Contact';

const {  } = reducer.actions;


function ContactListContainer({}) {
  const dispatch = useDispatch();
  return (<Contact
         />);
}

export default ContactListContainer;
