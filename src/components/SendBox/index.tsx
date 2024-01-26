import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { sendMessage } from 'modules/chat/actions/message';
import { Row, InputGroup, FormControl, Button } from 'react-bootstrap';

const SendBox: React.FC = () => {
    const dispatch = useDispatch();
    const [message, setMessage] = useState({value: ''});
    const user = useSelector((state: any) => {
        return state.login;
    });
    const handleChange = (event: any) => {
        setMessage({value: event.target.value});
    };
    const handleSubmit = (event: any) => {
        event.preventDefault();
        dispatch(sendMessage(message.value, user.username, user.id));
        setMessage({value: ''})
    };
    return (
        <form onSubmit={handleSubmit}>
            <footer className='footer'>
                <Row className='pl-5 pr-5'>
                    <InputGroup className="mb-3">
                        <FormControl
                            placeholder="Type your message here"
                            aria-label="Type your message"
                            aria-describedby="basic-addon2"
                            value={message.value}
                            onChange={handleChange}
                        />
                        <InputGroup.Append>
                            <Button
                                disabled={0 === message.value.length}
                                variant="outline-primary"
                                type="submit"
                                value="Submit"
                            >
                                Send
                            </Button>
                        </InputGroup.Append>
                    </InputGroup>
                </Row>
            </footer>
        </form>
    );
};

export default SendBox;
