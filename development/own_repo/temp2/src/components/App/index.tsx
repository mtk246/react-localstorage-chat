import React from 'react';
import ChatPage from 'components/Chat';
import { useSelector } from 'react-redux';

const App: React.FC = () => {
    const isLogged = useSelector((state: any) => {
        return state.login.isLogged;
    });

    return (
        <React.Fragment>
            <ChatPage />
        </React.Fragment>
    );
};

export default App;
