import React from 'react';

import apiTokenActionTypes from './apiToken.types';
import { API_ENDPOINT } from '../../data/config';


// Read
export const fetchApiTokensStart = () => ({
  type: apiTokenActionTypes.FETCH_API_TOKENS_START,
});

export const fetchApiTokensSuccess = deviceConnectionKey => ({
  type: apiTokenActionTypes.FETCH_API_TOKENS_SUCCESS,
  payload: deviceConnectionKey,
});

export const fetchApiTokensFailure = errorMessage => ({
  type: apiTokenActionTypes.FETCH_API_TOKENS_FAILURE,
  payload: errorMessage,
});

export const fetchApiTokensStartAsync = () => {
  return dispatch => {
    dispatch(fetchApiTokensStart());

    axios.get(`${API_ENDPOINT}/tokens`)
      .then(result => {
        dispatch(fetchApiTokensSuccess(result.data.result.deviceConnectionKey));
      })
      .catch(error => {
        dispatch(fetchApiTokensFailure(error.message));
      });
  };
};