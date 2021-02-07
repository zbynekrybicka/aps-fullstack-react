import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Menu from './Menu';
import Contacts from './Contacts';
import Campaigns from './Campaigns';
import Calls from './Calls';

const {  } = reducer.actions;

const SectionSelector = state => state.data.section;

function Manager({}) {
  const dispatch = useDispatch();
  const Section = useSelector(SectionSelector);
  return (
    <div className="Manager">
        <Menu />
        {(Section === 1) && <Contacts/>}
        {(Section === 2) && <Campaigns/>}
        {(Section === 3) && <Calls/>}
    </div>
  );
}

export default Manager;
