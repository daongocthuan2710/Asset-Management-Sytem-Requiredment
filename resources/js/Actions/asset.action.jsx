
import { userConstants, exceptionConstants } from "../Constants";
import UserService from "../Services/user.service"
const { GET_USER_EDIT,GET_USER_CREATE,GET_USER_INFO } = userConstants;
const { SUCCESS, CREATED } = exceptionConstants;

export const getAssetInfo = () => {
    return async function (dispatch) {
        const response = await UserService.getAssetInfo()
        const assetInfo = response.data
        const code = response.code
        if (code === SUCCESS) {
            dispatch({
                type: GET_ASSET_INFO,
                payload: {
                    data: assetInfo,
                },
            })
        }
        return response
    }
}