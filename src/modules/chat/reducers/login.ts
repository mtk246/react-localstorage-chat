import { AnyAction } from 'redux';

export type State = {
    username: string;
    isLogged: boolean;
    id: string;

};

export const initialState: State = {
    username: '',
    isLogged: false,
    id: '',

};

const login = (state = initialState, action: AnyAction) => {
    switch (action.type) {
        case 'USER_LOGIN':
            return {
                ...state,
                username: action.payload,
                id: action.payload
            };

        case 'USER_ID':
            return {
                ...state,
                id: action.payload
            };
        
        case 'USER_LOGGED':
            return {
                ...state,
                isLogged: action.payload
            };

        case 'SEND_MESSAGE':
            return {
                ...state,
            };

        default:
            return state
    };
};

export default login;