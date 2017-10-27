/**
 * Created by Spape on 20/10/2017.
 */
import axios from 'axios';

class HttpService {
    baseUrl = 'http://localhost/api';

    getLocations() {
        return axios.get(`${this.baseUrl}/location`).then(r => r.data);
    }

    getTechnicians() {
        return axios.get(`${this.baseUrl}/technicians`).then(r => r.data);
    }

    getIssuesOfLocatiton(id) {
        return axios.get(`${this.baseUrl}/issue/location/${id}`).then(r => r.data);
    }

    getStatusesOfLocation(id) {
        return axios.get(`${this.baseUrl}/status/location/${id}`).then(r => r.data);
    }

    addIssueEntry(issue) {
        return axios.post(`${this.baseUrl}/issue/add`, {
            problem: issue.problem,
            date: issue.date,
            handled: issue.handled,
            location_id: issue.location_id
        });
    }

    addTechnicianEntry(technician) {
        return axios.post(`${this.baseUrl}/technician/add`, {
            email: technician.email,
            name: technician.name,
            role: technician.role,
            password: technician.password
        });
    }
}

const httpService = new HttpService();

export default httpService