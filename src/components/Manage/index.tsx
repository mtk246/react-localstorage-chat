import React from 'react';
import { useDispatch } from 'react-redux';
import { cleanState } from 'modules/chat/actions/message';

const Manage: React.FC = () => {
    const dispatch = useDispatch();
    const resetData = () => { 
        dispatch(cleanState());
    }

    return (
        <div className="ml-auto">
            <button onClick={resetData} className='btn btn-danger'>Reset data</button>
        </div>
    );
};

export default Manage;