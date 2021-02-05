import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setlangLoginFormUsername } = reducer.actions;

const langLoginFormUsernameSelector = state => state.data.loginForm.username;
const LoginFormUsernameLangSelector = state => state.data.lang[state.data.activeLang].loginForm.username;

function Username({}) {
  const dispatch = useDispatch();
  const langLoginFormUsername = useSelector(langLoginFormUsernameSelector);
  const LoginFormUsernameLang = useSelector(LoginFormUsernameLangSelector);
  return (<input
            type={'text'}
            defaultValue={langLoginFormUsername}
            onInput={e => dispatch(setlangLoginFormUsername(e.target.value))}
            placeholder={LoginFormUsernameLang}
            onKeyDown={e => e.key === "Enter" && dispatch(postLogin())}
         />);
}

export default Username;
