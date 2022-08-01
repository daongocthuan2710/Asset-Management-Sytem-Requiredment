import Repository from "./repository";

class AssetService {
    async getAssetInfo(id) {
        const endpoint = `/asset/${id}`;
        const response = await Repository.get(endpoint);
        return response;
    }

    async getAssetEdit(id) {
        const endpoint = `/asset/${id}/edit`;
        const response = await Repository.get(endpoint);
        return response;
    }

    async updateAssetInfo(assetId, date_of_birth, gender, joined_date, type) {
        const endpoint = `/asset/${assetId}/?date_of_birth=${date_of_birth}&gender=${gender}&joined_date=${joined_date}&admin=${type}`;
        const response = await Repository.put(endpoint);
        return response;
    }

    async getAssetById(assetId) {
        const endpoint = `/asset/${assetId}`;
        const response = await Repository.get(endpoint);
        return response;
    }
}
export default new AssetService();
