import Repository from "./repository";

class AssignmentService {
    async getAssignmentInfo(id) {
        const endpoint = `/assignment/${id}`;
        const response = await Repository.get(endpoint);
        return response;
    }

    async getAssignmentEdit(id) {
        const endpoint = `/assignment/${id}/edit`;
        const response = await Repository.get(endpoint);
        return response;
    }

    async updateAssignmentInfo(data) {
        const endpoint = `/assignment/${data.assignmentId}?installed_date=${data.installed_date}&name=${data.name}&specification=${data.specification}&state=${data.state}`;
        const response = await Repository.put(endpoint);
        return response;
    }
}
export default new AssignmentService();
