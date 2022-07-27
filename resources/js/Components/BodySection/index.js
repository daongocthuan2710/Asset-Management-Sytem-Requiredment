import React, {useEffect,useState} from "react";
import Sidebar from "../Sidebar";
import './style.scss'
import { ManageUser } from "../TableManageUser";
import userEditReducer from "../../Reducers/userEdit.reducer";
import { useSelector} from "react-redux";
import EditForm from "../ManageUser/EditUser";
// no khong hieu o khuc nay`

export default function BodySection() {
    // const [userEditReducer, setUserEditReducer] = useState(false);
    const userEditReducer = useSelector(state => state.userEditReducer.value);
    // setUserEditReducer(useSelector(state => state.userEditReducer.value));
    // useEffect(() => {

    // }, [userEditReducer])
    console.log('userEditReducer',userEditReducer);
    return (
        <div className='body-section'>
            <div className='sidebar col-lg-3 col-md-6 col-sm-12'>
                <Sidebar />
            </div>
            <div className='body-content col-lg-9 col-md-6 col-sm-12'>
                {(userEditReducer) ? <EditForm/> : <ManageUser />}
            </div>
        </div>
    )
}
