import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const {  } = reducer.actions;

const LoginFormLoginLangSelector = state => state.data.lang[state.data.activeLang].loginForm.login;

function Login({}) {
  const dispatch = useDispatch();
  const LoginFormLoginLang = useSelector(LoginFormLoginLangSelector);
  return (<button
            className={'blue'}
            onClick={e => dispatch(postLogin())}
        >{LoginFormLoginLang}</button>);
}

export default Login;
