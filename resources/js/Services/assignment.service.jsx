import Repository from "./repository";

class AssignmentService {
    async getAssignmentById(id) {
        const endpoint = `/assignment/${id}`;
        const response = await Repository.get(endpoint);
        return response;
    }
}
export default new AssignmentService();
