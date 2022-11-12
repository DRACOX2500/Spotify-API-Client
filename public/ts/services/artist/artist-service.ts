import { HttpService } from "../http-service";
import { PHP_API } from "../../constant";

export class ArtistService {

    static async get(id: string, callback: (response: any) => void) {
        await HttpService.get(`${PHP_API.ARTIST.PROFILE}${id}`, (response) => callback(response))
    }
}