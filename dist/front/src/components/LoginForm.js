import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Username from './Username';
import Password from './Password';
import Login from './Login';

const {  } = reducer.actions;

const LoginFormHeaderLangSelector = state => state.data.lang[state.data.activeLang].loginForm.header;

function LoginForm({}) {
  const dispatch = useDispatch();
  const LoginFormHeaderLang = useSelector(LoginFormHeaderLangSelector);
  return (
    <div className="LoginForm">
        <h1
        >{LoginFormHeaderLang}</h1>
        <Username
         />
        <Password
         />
        <Login
         />
    </div>
  );
}

export default LoginForm;
