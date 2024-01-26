export const STORAGE_KEY = 'lonely-chat:messages';

export const loadMessages = () => {
    const tryValue = localStorage.getItem(STORAGE_KEY);
    try {
        const value = JSON.parse(tryValue);
        if (Array.isArray(value)) {
            return value;
        }
        else {
            return [];
        }
    }
    catch {
        return [];
    }
};

export const saveMessages = (values: any[]) => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(values));
};