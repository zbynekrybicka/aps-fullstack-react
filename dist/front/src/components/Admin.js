import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
const {  } = reducer.actions;

function Admin({}) {
  const dispatch = useDispatch();
  return (
            <div>{'Gratuluji. Jste přihlášení!'}</div>
    );
}
export default Admin;