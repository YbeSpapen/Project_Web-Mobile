/**
 * Created by Spape on 20/10/2017.
 */
import axios from 'axios';

class HttpService {
    baseUrl = 'http://192.168.33.11/WP1';

    getLocations() {
        return axios.get(`${this.baseUrl}/location`).then(r => r.data);
    }

    addLocation(location) {
        return axios.post(`${this.baseUrl}/location/add`, {
            name: location.name
        });
    }

    getTechnicians() {
        return axios.get(`${this.baseUrl}/technicians`).then(r => r.data);
    }

    getIssuesOfLocatiton(id) {
        return axios.get(`${this.baseUrl}/issue/location/${id}`).then(r => r.data);
    }

    getIssuesOfTechnician(id) {
        return axios.get(`${this.baseUrl}/issue/technician/${id}`).then(r => r.data);
    }
Z
    getStatusesOfLocation(id) {
        return axios.get(`${this.baseUrl}/status/location/${id}`).then(r => r.data);
    }

    getStatusPercentage() {
        return axios.get(`${this.baseUrl}/status/percentage`).then(r => r.data);
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

    assignTechnician(issue) {
        return axios.post(`${this.baseUrl}/issue/assignTechnician`, {
            issue_id: issue.issue_id,
            technician_id: issue.technician_id
        });
    }

    addStatus(status) {
        return axios.post(`${this.baseUrl}/status/add`, {
            location_id: status.location_id,
            status: status.status,
            date: status.date,
        });
    }
}

const httpService = new HttpService();

export default httpService