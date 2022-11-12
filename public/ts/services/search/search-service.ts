import { HttpService } from "../http-service";
import { PHP_API } from "../../constant";

export class SearchService {

    static async all(query: string, callback: (response: any) => void) {
        await HttpService.get(`${PHP_API.SEARCH}?query=${query}`, (response) => callback(response))
    }

    static async artists(query: string, callback: (response: any) => void) {
        await HttpService.get(`${PHP_API.SEARCH}?query=${query}&type=artist`, (response) => callback(response))
    }

    static async albums(query: string, callback: (response: any) => void) {
        await HttpService.get(`${PHP_API.SEARCH}?query=${query}&type=album`, (response) => callback(response))
    }
}