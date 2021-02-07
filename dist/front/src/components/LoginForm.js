import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';

const { setLoginFormUsername, setLoginFormPassword } = reducer.actions;

const loginFormUsernameSelector = state => state.data.loginForm.username;
const loginFormPasswordSelector = state => state.data.loginForm.password;

function LoginForm({}) {
  const dispatch = useDispatch();
  const loginFormUsername = useSelector(loginFormUsernameSelector);
  const loginFormPassword = useSelector(loginFormPasswordSelector);
  return (
    <div className="LoginForm">
        <input
            type={'text'}
            placeholder={'Přihlašovací jméno'}
            defaultValue={loginFormUsername}
            onInput={e => dispatch(setLoginFormUsername(e.target.value))}
         />
        <input
            type={'password'}
            placeholder={'Heslo'}
            defaultValue={loginFormPassword}
            onInput={e => dispatch(setLoginFormPassword(e.target.value))}
         />
        <button
            className={'blue'}
            onClick={() => dispatch(postLogin())}
        >{'Přihlásit se'}</button>
    </div>
  );
}

export default LoginForm;
