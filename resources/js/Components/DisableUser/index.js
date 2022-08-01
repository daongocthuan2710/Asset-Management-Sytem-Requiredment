import React, { useState, useEffect } from 'react';
import { Button, Modal } from "react-bootstrap";
import './style.scss';
import axios from 'axios';

export default function DisableUser(props) {


    const [haveAssignment, setHaveAssignment] = useState(false);
    const [show, setShow] = useState(props.show);
    useEffect(async () => {
        if (props.show) setShow(Boolean(true));
        const response = await axios.get(`/api/can-disable/${props.id}`);
        setHaveAssignment(response.data.disable);
    }, [props.show])


    const handleDisableUser = async (e) => {
        try {
            const token = localStorage.getItem('token')
            const headers = {headers: {Authorization: `Bearer ${token}`}};
            await axios.get(`/api/disable/${props.id}`, headers);
            setShow(false)
            window.location.reload();
        } catch (e) {
            const error = new Error("Something went wrong");
            throw error;
        }
    }


    const handleClose = () => {
        setShow(false)
    };


    return (
        <>
            {(!haveAssignment) ?
                <Modal
                    show={show}
                    backdrop="static"
                    keyboard={false}
                >
                    <Modal.Header>
                        <Modal.Title>Are you sure?</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <div>
                            <p>
                                Do you want disable this user?
                            </p>
                            <Button
                                onClick={handleDisableUser}
                                id="disableUserButton"
                                variant="light">
                                Disable
                            </Button>
                            <b>  </b>
                            <Button
                                onClick={handleClose}
                                id="cancelDisableUserButton"
                                variant="light">
                                Cancel
                            </Button>
                        </div>
                    </Modal.Body>
                </Modal>
                :
                <Modal
                    show={show}
                    backdrop="static"
                    keyboard={false}
                >
                    <Modal.Header>
                        <Modal.Title>Can not disable user</Modal.Title>
                        <Button onClick={handleClose}>X</Button>
                    </Modal.Header>
                    <Modal.Body>
                        <div>
                            <p>
                                There are valid assignments belonging to this user. Please close all assignments before
                                disabling user.
                            </p>
                        </div>
                    </Modal.Body>
                </Modal>
            }
        </>
    );
}
