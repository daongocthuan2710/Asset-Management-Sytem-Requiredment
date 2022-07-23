import { combineReducers } from 'redux'
import testReducer from "./test.reducer";
import homeReducer from "./home.reducer";
import userReducer from "./user.reducer";

const appReducer = combineReducers({
    testReducer, homeReducer, userReducer
})
const rootReducer = (state, action) => {
    return appReducer(state, action)
}
export default rootReducer;
