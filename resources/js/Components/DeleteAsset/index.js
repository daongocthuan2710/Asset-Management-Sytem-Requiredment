import React, { useState, useEffect } from 'react';
import { Button, Modal } from "react-bootstrap";
import './style.scss';
import axios from 'axios';
import {Link} from "react-router-dom";
import {FaRegWindowClose} from "react-icons/fa";

export default function DeleteAsset(props) {
    const [haveAssignment, setHaveAssignment] = useState(false);
    const [show, setShow] = useState(Boolean(props.show));
    useEffect(async () => {
        if (props.show) setShow(Boolean(true));
        // const response = await axios.get(`/api/asset/${props.id}/can-delete`);
        const response = await axios.get('/api/asset/6/can-delete');
        console.log(response.data)
        setHaveAssignment(response.data.valid);
    }, [props.show])

    const handleDisableUser = async (e) => {
        try {
            // const token = localStorage.getItem('token')
            // const headers = {headers: {Authorization: `Bearer ${token}`}};
            // await axios.delete(`/api/${props.id}`, headers);
            // setShow(false)
            setShow(false);
            // window.location.reload();
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
                        <Modal.Title id='modalText'>Are you sure?</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <div id='modalText'>
                            <p>
                                Do you want delete this asset?
                            </p>
                            <Button
                                onClick={handleDisableUser}
                                id="disableUserButton"
                                variant="light">
                                Delete
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
                        <Modal.Title id='modalText'>Can not delete asset</Modal.Title>
                        <FaRegWindowClose onClick={handleClose} style={{ cursor: 'pointer' }} />
                    </Modal.Header>
                    <Modal.Body>
                        <div id='modalText'>
                            <p>
                                Cannot delete this asset because it belongs to one or more historical assignments.
                            </p>
                            <p>
                                If this asset is not able to be use anymore, please update its state in <Link>Edit Asset page</Link>.
                            </p>
                        </div>
                    </Modal.Body>
                </Modal>
            }
        </>
    );
}
