import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import postLogin from '../actions/postLogin.js';
const { setUsername, setPassword } = reducer.actions;
const usernameSelector = state => state.data.loginForm.username;
const passwordSelector = state => state.data.loginForm.password;

function LoginForm({}) {
  const dispatch = useDispatch();
  const username = useSelector(usernameSelector);
  const password = useSelector(passwordSelector);
  return (
    <div className="LoginForm">
        <input
            type={'text'}
            placeholder={'Přihlašovací jméno'}
            defaultValue={username}
            onInput={e => dispatch(setUsername(e.target.value))}
         />
        <input
            type={'password'}
            placeholder={'Heslo'}
            defaultValue={password}
            onInput={e => dispatch(setPassword(e.target.value))}
         />
        <button
            className={'blue'}
            onClick={() => dispatch(postLogin())}
        >{'Přihlásit se'}</button>
    </div>);
}
export default LoginForm;