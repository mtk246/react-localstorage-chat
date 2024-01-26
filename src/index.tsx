import React from 'react';
import { render } from 'react-dom';
import App from 'components/App';
import { Provider } from 'react-redux';
import configureStore from './modules/configureStore';
import { loadMessages, saveMessages, STORAGE_KEY } from './lib/storage';
import { loadStorageMessages } from 'modules/chat/actions/message';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'styles/index.css';

const TARGET_ROOT = document.getElementById('root');

const store = configureStore({
    login: {
        isLogged: false,
        username: '',
        id: ''
    },
    messages: {
        message: loadMessages()
    }
});

store.subscribe(() => {
    const state = store.getState();
    saveMessages(state.messages.message || []);
});

window.addEventListener('storage', e => {
    if (e.key !== STORAGE_KEY) {
        return;
    }

    const loadedMessages = JSON.parse(e.newValue);
    if (!Array.isArray(loadedMessages)) {
        return;
    }

    store.dispatch(loadStorageMessages(loadedMessages));
});

render(
    <Provider store={store}>
        <App/>
    </Provider>,
    TARGET_ROOT
)
