import React from "react";
import Sidebar from "../Sidebar";
import './style.scss'
import { HomeTable } from "../Table";
// no khong hieu o khuc nay`

export default function BodySection() {
    return (
        <div className='body-section'>
            <div className='sidebar col-lg-3 col-md-6 col-sm-12'>
                <Sidebar />
            </div>
            <div className='body-content col-lg-9 col-md-6 col-sm-12'>
                <h3>My Assignment</h3>
                <HomeTable />
            </div>
        </div>
    )
}
