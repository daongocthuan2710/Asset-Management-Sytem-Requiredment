import { combineReducers } from 'redux';
import testReducer from "./test.reducer";
import homeReducer from "./home.reducer";
import userReducer from "./user.reducer";
import userEditReducer from "./userEdit.reducer";
const appReducer = combineReducers({
    testReducer, homeReducer, userReducer, userEditReducer
})
const rootReducer = (state, action) => {
    return appReducer(state, action)
}
export default rootReducer;
