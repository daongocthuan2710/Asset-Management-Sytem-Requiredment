import React from "react";
import { Route, Switch } from "react-router-dom";
import Sidebar from "../Sidebar";
import "./style.scss";
import { ManageUser } from "../TableManageUser";
import Test from "../Test";
import ManageAsset from "../ManageAsset";
import userEditReducer from "../../Reducers/userEdit.reducer";
import { useSelector } from "react-redux";
import EditForm from "../ManageUser/EditUser";

export default function BodySection() {
    const userEditReducer = useSelector((state) => state.userEditReducer.value);
    return (
        <div className="body-section">
            <div className="sidebar col-lg-3 col-md-6 col-sm-12">
                <Sidebar />
            </div>
            <div className="body-content col-lg-9 col-md-6 col-sm-12">
                <Switch>
                    <Route exact path="/">
                        <div>HOME</div>
                    </Route>
                    <Route path="/home">
                        <div>HOME</div>
                    </Route>
                    <Route path="/manage-user">
                        {userEditReducer ? <EditForm /> : <ManageUser />}
                    </Route>
                    <Route path="/manage-asset">
                        <ManageAsset />
                    </Route>
                    <Route path="/manage-assignment">
                        <Test />
                    </Route>
                    <Route path="/request-for-returning">
                        <Test />
                    </Route>
                    <Route path="/report">
                        <Test />
                    </Route>
                </Switch>
            </div>
        </div>
    );
}
