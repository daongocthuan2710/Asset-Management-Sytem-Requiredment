import React, { useEffect, useState } from 'react'
import { NavbarBrand } from "reactstrap"
import ListGroup from 'react-bootstrap/ListGroup'
import './style.scss'
import { useDispatch, useSelector } from "react-redux"
import { updateTitleHeader } from "../../Actions"
import nashtechlogo from "../../../assets/nashtech_logo.svg";


export default function Sidebar() {
    const [sidebarName, setSidebarName] = useState('Home')
    const dispatch = useDispatch()
    const data = useSelector(state => state.userReducer.userInfo);

    let sidebarItems;
    // if (data.length > 0) {
    if (data.admin === true) {
        sidebarItems = [
            'Home', 'Manage User', 'Manage Asset', 'Manage Assignment', 'Request for Returning', 'Report'
        ]
    } else {
        // } else if (data.admin === false) {
        sidebarItems = [
            'Home'
        ]
    }
    // }

    const handleClickSidebar = (e) => {
        setSidebarName(e.target.dataset.name)
    }
    useEffect(() => {
        dispatch(updateTitleHeader(sidebarName))

    }, [handleClickSidebar])

    const dataBindingGrid = () => sidebarItems.map((item, index) => {
        return (
            <ListGroup.Item data-name={item} key={index} action href={`#link${index + 1}`} onClick={e => handleClickSidebar(e)}>
                {item}
            </ListGroup.Item>
        )
    })
    return (
        <div className='sidebar-wrap'>
            <div className='row'>
                <div className='sidebar-brand'>
                    <NavbarBrand>
                        <img width="200" height="200"src={nashtechlogo}  />
                        <h4><b>Online Asset Management</b></h4>
                    </NavbarBrand>
                </div>
            </div>
            <div className='row'>
                <div className='col-lg-12'>
                    <div className='sidebar-select'>
                        <ListGroup defaultActiveKey="#link1">
                            {dataBindingGrid()}
                        </ListGroup>
                    </div>
                </div>
            </div>
        </div>
    )
}
