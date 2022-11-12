export interface API {

    /**
     * __/search/ajax/__
     *
     * __query__: query prompt
     *
     * __type__: type of search
     *
     * example:
     * /search/ajax/?query={query}&type={type}
     */
    readonly SEARCH: string,

    readonly ARTIST: {

        /**
         * __/artist/ajax/__
         *
         * __id__: artist ID
         *
         * example:
         * /artist/ajax/{id}
         */
        readonly PROFILE: string,

        /**
         * __/album/ajax/__
         *
         * __id__: album ID
         *
         * example:
         * /album/ajax/{id}
         */
        readonly ALBUMS: string,
    },

    /**
     * __/album/ajax2/__
     *
     * __id__: album ID
     *
     * example:
     * /album/ajax2/{id}
     */
    readonly ALBUM: string,
}