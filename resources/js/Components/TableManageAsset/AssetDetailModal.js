import React from "react";
import { Modal } from "react-bootstrap";
import { FaRegWindowClose } from "react-icons/fa"
import moment from "moment";
export default function AssetDetailModal({
    modal, user,
    setModal
}) {
    return (
        <>
            <Modal
                show={modal}
                size="lg"
                onHide={() => setModal(false)}
                aria-labelledby="contained-modal-title-vcenter"
                centered
            >
                <Modal.Header className="w-100">
                    <Modal.Title id="contained-modal-title-vcenter" className="d-flex justify-content-betweeen align-items-center w-100 flex-grow-1">
                        <h4 className="flex-grow-1"> Detailed Asset Information</h4>
                        <FaRegWindowClose onClick={() => setModal(false)} style={{ cursor: 'pointer' }} />
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div className="d-flex">
                        <p className="w-25">Asset Code</p>
                        <p className="w-75">{user.asset_code}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Asset Name</p>
                        <p className="w-75">{user.name}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Username</p>
                        <p className="w-75">{user.username}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Date of Birth</p>
                        <p className="w-75">{moment(user.birthday).format('DD/MM/YYYY')}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Gender</p>
                        <p className="w-75">{user.gender}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Joined Date</p>
                        <p className="w-75">{user.joined_date}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Type</p>
                        <p className="w-75">{user.admin ? 'Admin' : 'Staff'}</p>
                    </div>
                    <div className="d-flex">
                        <p className="w-25">Location</p>
                        <p className="w-75">{user.location}</p>
                    </div>
                </Modal.Body>
            </Modal>
        </>
    );
}