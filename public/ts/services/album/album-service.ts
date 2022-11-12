import {HttpService} from "../http-service";
import {PHP_API} from "../../constant";

export class AlbumService {

    static async get(id: string, callback: (response: any) => void) {
        await HttpService.get(`${PHP_API.ALBUM}${id}`, (response) => callback(response))
    }
}