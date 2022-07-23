import React, { useState, useEffect } from 'react';
import { Button, Modal } from "react-bootstrap";
import './style.scss';
import axios from 'axios';

export default function LogOut(props) {

    const [show, setShow] = useState(props.show)

    useEffect(() => {
        if(props.show) setShow(Boolean(true))
    },[props.show])

    

    const handleLogout = async (e) => {
        try {
            const basePath = "http://localhost:8000/api/"
            const token = localStorage.getItem('token')
            const headers = { headers: { Authorization: `Bearer ${token}` } };
            axios.get(basePath + 'logout', headers)
                .then(resp => {
                    localStorage.clear()
                    window.location.reload()
                })
        } catch (e) {
            const error = new Error("Something went wrong");
            throw error;
        }
    }
    const handleClose = () => {setShow(false)};
    return (
        <>
            <Modal
                show={show}
                backdrop="static"
                keyboard={false}
            >
                <Modal.Header>
                    <Modal.Title>Are you sure?</Modal.Title>
                </Modal.Header>
                <Modal.Footer>
                    <div>
                        <p>
                            Do you want to log out?
                        </p>
                    </div>
                    <div>
                        <Button onClick={handleLogout} className="primaryButton">Log out</Button>
                        <Button onClick={handleClose} className="secondaryButton">Cancel</Button>
                    </div>
                </Modal.Footer>
            </Modal>
        </>
    );
}