import { combineReducers } from 'redux';
import login, { State as AccountState } from 'modules/chat/reducers/login';
import messages, { State as MessageState } from 'modules/chat/reducers/message';

export type RootState = {
    login: AccountState
    messages: MessageState;
}

export default combineReducers<RootState>({
    login,
    messages
})