import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import ManagerMenu from './ManagerMenu';
import ContactSection from './ContactSection';
import CampaignSection from './CampaignSection';
import CallSection from './CallSection';

const {  } = reducer.actions;

const SectionSelector = state => state.data.section;

function Manager({}) {
  const dispatch = useDispatch();
  const Section = useSelector(SectionSelector);
  return (
    <div className="Manager">
        <ManagerMenu
         />
        {Section === 0 && <ContactSection
        />}
        {Section === 1 && <CampaignSection
        />}
        {Section === 2 && <CallSection
        />}
    </div>
  );
}

export default Manager;
