import axios from "axios";

export class HttpService {

    static async get(url: string, callback: (response: any) => void): Promise<void> {
        axios.get(url)
            .then((res) => callback(res.data))
            .catch((error) => console.error(error))
    }
}