/**
 * Created by Spape on 20/10/2017.
 */
import axios from 'axios';

class HttpService{
    baseUrl = 'http://localhost/api';

    getLocations(){
        return axios.get(`${this.baseUrl}/location`).then(r => r.data);
    }

    getIssuesOfLocatiton(id){
        return axios.get(`${this.baseUrl}/issue/location/${id}`).then(r => r.data);
    }

    getStatusesOfLocation(id){
        return axios.get(`${this.baseUrl}/status/location/${id}`).then(r => r.data);
    }
}

const httpService = new HttpService();

export default httpService