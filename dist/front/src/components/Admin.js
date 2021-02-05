import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Operator from './Operator';
import Manager from './Manager';

const {  } = reducer.actions;

const UserRoleSelector = state => state.data.user.role;

function Admin({}) {
  const dispatch = useDispatch();
  const UserRole = useSelector(UserRoleSelector);
  return (
    <div className="Admin">
        {UserRole === 1 && <Operator
        />}
        {UserRole === 2 && <Manager
        />}
    </div>
  );
}

export default Admin;
