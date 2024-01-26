import React from 'react';

interface Props {
    isOwn?: boolean;
    sender: string;
}

const Message: React.FC<Props> = (props) => {
    const owner = props.isOwn;
    return (
        <React.Fragment>
            {
                owner ? (
                    <li className="clearfix pb-3">
                        <div className="message-data text-right">
                            <span className="font-weight-bold">{props.sender}</span>
                        </div>
                        <div className="badge badge-primary text-wrap text-break float-right"  style={{padding: '15px', fontSize: 16}}>{props.children}</div>
                    </li>
                ) : (
                    <li className="clearfix pb-3">
                        <div className="message-data">
                            <span className="font-weight-bold">{props.sender}</span>
                        </div>
                        <div className="badge badge-secondary text-wrap text-break" style={{padding: '15px', fontSize: 16, background: '#ebebeb', color: '#6c757d'}}>{props.children}</div>
                    </li>
                )
            }
        </React.Fragment>
    );
};

export default Message;
