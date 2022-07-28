import Repository from './repository'

class UserService {
    async getUserInfo() {
        const endpoint = '/user-information'
        const response = await Repository.post(endpoint)
        return response
    }

    async getUserEdit(id) {
        const endpoint = `/user/${id}/edit`
        const response = await Repository.get(endpoint)
        return response
    }
}
export default new UserService()
