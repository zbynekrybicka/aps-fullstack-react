import React from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { reducer } from '../store';
import LoginForm from './LoginForm';
import Admin from './Admin';
import ping from '../actions/ping.js';
const {  } = reducer.actions;
const AuthTokenSelector = state => state.data.authToken;

function App({}) {
  const dispatch = useDispatch();
    dispatch(ping());
  const AuthToken = useSelector(AuthTokenSelector);
  return (
    <div className="App">
        {!AuthToken && <LoginForm />}
        {AuthToken && <Admin />}
    </div>);
}
export default App;