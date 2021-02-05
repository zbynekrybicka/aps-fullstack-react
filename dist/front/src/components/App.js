import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import Langs from './Langs';
import LoginForm from './LoginForm';
import Admin from './Admin';

const {  } = reducer.actions;

const AuthTokenSelector = state => state.data.authToken;

function App({}) {
  const dispatch = useDispatch();
  const AuthToken = useSelector(AuthTokenSelector);
  return (
    <div className="App">
        <Langs
         />
        {!AuthToken && <LoginForm
        />}
        {AuthToken && <Admin
        />}
    </div>
  );
}

export default App;
