import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setLoginFormusername, setLoginFormpassword } = reducer.actions;

const langloginFormHeaderSelector = state => state.data.lang[state.data.activeLang].loginForm.header;
const langloginFormUsernameSelector = state => state.data.lang[state.data.activeLang].loginForm.Username;
const loginFormusernameSelector = state => state.data.loginForm.username;
const langloginFormPasswordSelector = state => state.data.lang[state.data.activeLang].loginForm.Password;
const loginFormpasswordSelector = state => state.data.loginForm.password;
const langloginFormPostLoginSelector = state => state.data.lang[state.data.activeLang].loginForm.postLogin;
const langerrorMessagesPostLoginFailSelector = state => state.data.lang[state.data.activeLang].errorMessages.postLoginFail;

function LoginForm({}) {
  const dispatch = useDispatch();
  const langloginFormHeader = useSelector(langloginFormHeaderSelector);
  const langloginFormUsername = useSelector(langloginFormUsernameSelector);
  const loginFormusername = useSelector(loginFormusernameSelector);
  const langloginFormPassword = useSelector(langloginFormPasswordSelector);
  const loginFormpassword = useSelector(loginFormpasswordSelector);
  const langloginFormPostLogin = useSelector(langloginFormPostLoginSelector);
  const langerrorMessagesPostLoginFail = useSelector(langerrorMessagesPostLoginFailSelector);
  return (
    <div className="LoginForm">
        <h1>{langloginFormHeader}</h1>
        <input
            type={'text'}
            placeholder={langloginFormUsername}
            defaultValue={loginFormusername}
            onInput={e => dispatch(setLoginFormusername(e.target.value))}
         />
        <input
            type={'password'}
            placeholder={langloginFormPassword}
            defaultValue={loginFormpassword}
            onInput={e => dispatch(setLoginFormpassword(e.target.value))}
         />
        <button
            onClick={() => dispatch(postLogin())}
        >{langloginFormPostLogin}</button>
    </div>
  );
}

export default LoginForm;
