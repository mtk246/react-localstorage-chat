export const setLogin = (name: string) => {
    return {
        type: 'USER_LOGIN',
        payload: name
    };
};

export const setUserId = (id: string) => {
    return {
        type: 'USER_ID',
        payload: id
    };
};

export const setLogged = (loading: boolean) => {
    return {
        type: 'USER_LOGGED',
        payload: loading
    };
};

export const login = (username: string, uid: string) => {
    return (dispatch: any) => {
        dispatch(setLogin(username));
        dispatch(setUserId(uid));
        dispatch(setLogged(true));
    }
}