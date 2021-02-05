import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ContactContainer from './ContactContainer';


const {  } = reducer.actions;

const AppDataManagerContactMapSelector = state => state.data.appData.manager.contact;

function Contact({}) {
  const dispatch = useDispatch();
  const AppDataManagerContactMap = useSelector(AppDataManagerContactMapSelector);
  return (<div
            className={'list'}
        >{AppDataManagerContactMap.map((item, i) => <ContactContainer key={'Contact' + i} item={item} />)}</div>);
}

export default Contact;
