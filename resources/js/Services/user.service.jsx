import Repository from './repository'

class UserService {
    async getUserInfo() {
        const endpoint = '/user-information'
        const response = await Repository.get(endpoint)
        return response
    }

    async getUserEdit(id) {
        const endpoint = `/user/${id}/edit`
        const response = await Repository.get(endpoint)
        return response
    }

    async updateUserInfo(userId,date_of_birth,gender,joined_date,type) {
        const endpoint = `/user/${userId}/?date_of_birth=${date_of_birth}&gender=${gender}&joined_date=${joined_date}&admin=${type}`
        const response = await Repository.put(endpoint)
        return response;
    }
}
export default new UserService()
