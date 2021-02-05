import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const {  } = reducer.actions;

const LoginFormHeaderLangSelector = state => state.data.lang[state.data.activeLang].loginForm.header;

function LoginForm({}) {
  const dispatch = useDispatch();
  const LoginFormHeaderLang = useSelector(LoginFormHeaderLangSelector);
  return (<h1
        >{LoginFormHeaderLang}</h1>);
}

export default LoginForm;
