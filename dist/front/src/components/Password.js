import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setLoginFormPassword } = reducer.actions;

const LoginFormPasswordSelector = state => state.data.loginForm.password;
const LoginFormPasswordLangSelector = state => state.data.lang[state.data.activeLang].loginForm.password;

function Password({}) {
  const dispatch = useDispatch();
  const LoginFormPassword = useSelector(LoginFormPasswordSelector);
  const LoginFormPasswordLang = useSelector(LoginFormPasswordLangSelector);
  return (<input
            type={'password'}
            defaultValue={LoginFormPassword}
            onInput={e => dispatch(setLoginFormPassword(e.target.value))}
            placeholder={LoginFormPasswordLang}
            onKeyDown={e => e.key === "Enter" && dispatch(postLogin())}
         />);
}

export default Password;
