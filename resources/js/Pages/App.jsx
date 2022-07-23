import React from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import Home from "./Home";
import SignIn from "./SignIn";
export default function App() {
    return (
        <Router>
            {localStorage.getItem('token') ? (
                <Switch>
                    <Route path="/">
                        <Home />
                    </Route>
                </Switch>
            ) :
                (
                    <Switch>
                        <Route path="/">
                            <SignIn />
                        </Route>
                    </Switch>
                )}
        </Router>
    );
}
