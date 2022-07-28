import { userConstants, exceptionConstants } from "../Constants";
import UserService from "../Services/user.service"
const { GET_USER_INFO } = userConstants;
const { GET_USER_EDIT } = userConstants;
const { SUCCESS } = exceptionConstants;

// export const getUserInfo = (data) => {
//     return async function (dispatch) {
//     // console.log(0, data);
//         dispatch({
//             type: GET_USER_INFO,
//             payload: {
//                 data: data,
//             },
//         });
//     };
// };

export const getUserInfo = () => {
    return async function (dispatch) {
        const response = await UserService.getUserInfo()
        const userInfo = response.data
        const code = response.code
        if (code === SUCCESS) {
            dispatch({
                type: GET_USER_INFO,
                payload: {
                    data: userInfo,
                },
            })
        }
        return response
    }
}

export const getUserEdit = (displayValue = false,userId) => {
    return async function (dispatch) {
        const response = await UserService.getUserEdit(userId)
        const userEdit = response.data
        const code = response.code
        if (code === SUCCESS) {
            dispatch({
                type: GET_USER_EDIT,
                payload: {
                    value: displayValue,
                    data: userEdit,
                },
            })
        }
        return response
    }
}


