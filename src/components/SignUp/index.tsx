import React, { useState } from 'react';
import { useDispatch } from 'react-redux';
import { login } from 'modules/chat/actions/login';
import uuid from 'uuid'
import { Container, Row, Col, Form, Button } from 'react-bootstrap';

const LoginForm: React.FC = () => {
    const dispatch = useDispatch();
    const [username, setUsername] = useState({value: ''})
    const handleChange = (event: any) => {
        setUsername({value: event.target.value});
    };
    const handleSubmit = (event: any) => {
        event.preventDefault();
        const uid = uuid()
        dispatch(login(username.value, uid));
    };
    return (
        <Container  style={{display: 'flex', alignItems: 'center', justifyContent: 'center'}}>
            <Row className="justify-content-md-center">
                <Col md="auto" className="p-5 rounded border custom-border">
                    <Form onSubmit={handleSubmit}>
                        <Form.Group controlId="formBasicEmail">
                            <Form.Label>Please enter your name</Form.Label>
                            <Form.Control type="text"
                                value={username.value}
                                onChange={handleChange}
                                placeholder="name or nickname" />
                        </Form.Group>
                        <Button
                            variant="primary"
                            disabled={0 === username.value.length}
                            type="submit"
                            value="Submit"
                        >
                            Enter Chat
                        </Button>
                    </Form>
                </Col>
            </Row>
        </Container>
    );
};

export default LoginForm;
