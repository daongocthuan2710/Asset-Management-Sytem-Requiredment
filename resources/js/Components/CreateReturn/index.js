import React, { useEffect, useState } from 'react';
import { Button, Modal } from "react-bootstrap";
import './style.scss';
import axios from 'axios';

export default function CreateReturn(props) {
    console.log(props)
    const [show, setShow] = useState(Boolean(props.show));
    useEffect(() => {
        if (props.show) setShow(Boolean(true));
    }, [props.show])

    const handleCreateReturn = async (e) => {
        try {
            const token = localStorage.getItem('token')
            const headers = { headers: { Authorization: `Bearer ${token}` } };
            console.log(headers)
            await axios.post(`/api/assignment/${props.id}/return`, '', headers);
            setShow(false);
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
            <Modal
                show={show}
                backdrop="static"
                keyboard={false}
            >
                <Modal.Header>
                    <Modal.Title id='modalText' style={{ margin: "0" }}>
                        Are you sure?
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div id='modalText'>
                        <p>
                            Do you want to create a returning request for this asset?
                        </p>
                        <Button
                            style={{ marginRight: "4px" }}
                            onClick={handleCreateReturn}
                            id="create-returning"
                            variant="light">
                            Yes
                        </Button>
                        <b>  </b>
                        <Button
                            onClick={handleClose}
                            id="cancel-create-returning"
                            variant="light">
                            No
                        </Button>
                    </div>
                </Modal.Body>
            </Modal>
        </>
    );
}
