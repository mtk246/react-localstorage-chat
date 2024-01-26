import React from 'react';
import SendBox from 'components/SendBox';
import ChatHistory from 'components/MessagesList';
import Manage from 'components/Manage';
import { Col, Row, Navbar } from 'react-bootstrap';
import logo from 'assets/logo192.png';

const ChatPage: React.FC = () => {
    return (
        <React.Fragment>
            <Row className='p-0 m-0'>
                <Col className='bg-light p-0 m-0'>
                    <Navbar bg="dark">
                        <Navbar.Brand href="/">
                        <img
                            src={logo}
                            width="30"
                            height="30"
                            className="d-inline-block align-top"
                            alt="React Bootstrap logo"
                        />
                        </Navbar.Brand>
                        <h3 className='text-white'>react chat</h3>
                        <Manage />
                    </Navbar>
                    <ChatHistory />
                    <SendBox />
                </Col>
            </Row>
        </React.Fragment>
    );
};

export default ChatPage;