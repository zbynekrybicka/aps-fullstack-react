import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';

const { RememberMeChecked } = reducer.actions;

const LoginFormRememberMeSelector = state => state.data.loginForm.rememberMe;
const LoginFormRememberMeLangSelector = state => state.data.lang[state.data.activeLang].loginForm.rememberMe;

function RememberMe({}) {
  const dispatch = useDispatch();
  const LoginFormRememberMe = useSelector(LoginFormRememberMeSelector);
  const LoginFormRememberMeLang = useSelector(LoginFormRememberMeLangSelector);
  return (
    <div className="RememberMe">
        <input
            type={'checkbox'}
            checked={LoginFormRememberMe}
            id={'RememberMeCheckboxId'}
            onChange={e => dispatch(RememberMeChecked(e.target.checked))}
         />
        <label
            htmlFor={'RememberMeCheckboxId'}
        >{LoginFormRememberMeLang}</label>
    </div>
  );
}

export default RememberMe;
