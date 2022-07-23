import Repository from './repository'

class UserService {
    async getUserInfo() {
        const endpoint = '/user-information'
        const response = await Repository.post(endpoint)
        return response
    }
}
export default new UserService()
