export const message = (data: any) => {
    return {
        type: 'SEND_MESSAGE',
        payload: data
    };
};

export const loadStorageMessages = (data: any) => {
    return {
        type: 'LOAD_STORAGE_MESSAGES',
        payload: data
    };
};

export const cleanState = () => {
    return (dispatch: any) => {
        const cleanItems: any = [];
        dispatch(message(cleanItems))
    }
}

export const sendMessage = (msg: string, user: string, uid: string) => {
    return (dispatch: any) => {
        const data = {
            name: user, 
            text: msg, 
            id: uid
        };
        dispatch(message(data));
    }
}
