/**
 * Created by Spape on 20/10/2017.
 */
import axios from 'axios';

class HttpService{
    baseUrl = 'http://192.168.33.11/WP1';

    getLocations(){
        return axios.get(`${this.baseUrl}/location`).then(r => r.data);
    }

    getIssuesOfLocatiton(id){
        return axios.get(`${this.baseUrl}/issue/location/${id}`).then(r => r.data);
    }

    getStatusesOfLocation(id){
        return axios.get(`${this.baseUrl}/status/location/${id}`).then(r => r.data);
    }

    addIssueEntry($issue){
        return axios.post(`${this.baseUrl}/issue/add`, { problem: $issue.problem, date: $issue.date, handled: $issue.handled, location_id: $issue.location_id });
    }
}

const httpService = new HttpService();

export default httpService