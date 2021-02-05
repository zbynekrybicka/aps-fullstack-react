import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setlangLoginFormPassword } = reducer.actions;

const langLoginFormPasswordSelector = state => state.data.loginForm.password;
const LoginFormPasswordLangSelector = state => state.data.lang[state.data.activeLang].loginForm.password;

function Password({}) {
  const dispatch = useDispatch();
  const langLoginFormPassword = useSelector(langLoginFormPasswordSelector);
  const LoginFormPasswordLang = useSelector(LoginFormPasswordLangSelector);
  return (<input
            type={'password'}
            defaultValue={langLoginFormPassword}
            onInput={e => dispatch(setlangLoginFormPassword(e.target.value))}
            placeholder={LoginFormPasswordLang}
            onKeyDown={e => e.key === "Enter" && dispatch(postLogin())}
         />);
}

export default Password;
