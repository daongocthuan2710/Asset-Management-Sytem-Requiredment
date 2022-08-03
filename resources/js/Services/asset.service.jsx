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

    async updateAssetInfo(data) {
        const endpoint = `/asset/${data.assetId}?installed_date=${data.installed_date}&name=${data.name}&specification=${data.specification}&state=${data.state}`;
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
