/*
 * Copyright (C) 2021 Intel Corporation
 * SPDX-License-Identifier: MIT
 */

import React from 'react';

import { CCol, CRow } from '@coreui/react';
import CIcon from '@coreui/icons-react';

const ContentError = ({errorMessage}) => {
  return (
    <CRow className="justify-content-center">
      <CCol md="6">
        <div className="clearfix text-center mt-5">
          <CIcon size="5xl" name="cil-warning"/>
          <h4 className="pt-3">Oops! Something went wrong.</h4>
          <p className="text-muted">
            Sorry, this page isn't available. The link you followed may be broken or the page may have been removed.</p>
        </div>
      </CCol>
    </CRow>
  );
};

export default ContentError;
