import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import CzLang from './CzLang';
import EnLang from './EnLang';

const {  } = reducer.actions;


function Langs({}) {
  const dispatch = useDispatch();
  return (
    <div className="Langs">
        <CzLang
         />
        <EnLang
         />
    </div>
  );
}

export default Langs;
