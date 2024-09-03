import App from "./App";
//import React from 'react';
//import ReactDOM from 'react-dom/client'

export const BlockTemplateRender = () => {

    console.log('BlockTemplateRender');
    ReactDOM.render(<App />, document.getElementById('skouerr-block-template'));
}
