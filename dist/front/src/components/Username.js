import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setLoginFormUsername } = reducer.actions;

const LoginFormUsernameSelector = state => state.data.loginForm.username;
const LoginFormUsernameLangSelector = state => state.data.lang[state.data.activeLang].loginForm.username;

function Username({}) {
  const dispatch = useDispatch();
  const LoginFormUsername = useSelector(LoginFormUsernameSelector);
  const LoginFormUsernameLang = useSelector(LoginFormUsernameLangSelector);
  return (<input
            type={'text'}
            defaultValue={LoginFormUsername}
            onInput={e => dispatch(setLoginFormUsername(e.target.value))}
            placeholder={LoginFormUsernameLang}
            onKeyDown={e => e.key === "Enter" && dispatch(postLogin())}
         />);
}

export default Username;
