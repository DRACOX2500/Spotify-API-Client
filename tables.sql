CREATE TABLE IF NOT EXISTS `artist` (
                          `id` INT(11) NOT NULL AUTO_INCREMENT,
                          `idSpotify` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                          `href` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                          `name` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                          `type` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                          `uri` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                          `popularity` INT(11) NULL DEFAULT NULL,
                          `externalUrl` LONGTEXT NOT NULL COLLATE 'utf8mb4_bin',
                          `follower` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_bin',
                          `genres` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_bin',
                          `image` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_bin',
                          PRIMARY KEY (`id`) USING BTREE,
                          CONSTRAINT `externalUrl` CHECK (json_valid(`externalUrl`)),
                          CONSTRAINT `follower` CHECK (json_valid(`follower`)),
                          CONSTRAINT `genres` CHECK (json_valid(`genres`)),
                          CONSTRAINT `image` CHECK (json_valid(`image`))
)
    COLLATE='utf8mb3_bin'
ENGINE=InnoDB
AUTO_INCREMENT=9
;

CREATE TABLE IF NOT EXISTS `album` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `releaseDatePrecision` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `releaseDate` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `albumGroup` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `idSpotify` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `albumType` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `label` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `type` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `href` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `uri` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `totalTracks` INT(11) NOT NULL DEFAULT '0',
                         `popularity` INT(11) NULL DEFAULT '0',
                         `availableMarkets` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `externalUrls` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `externalIds` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `copyrights` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `artists` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `genres` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `images` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         PRIMARY KEY (`id`) USING BTREE,
                         CONSTRAINT `artists` CHECK (json_valid(`artists`)),
                         CONSTRAINT `availableMarkets` CHECK (json_valid(`availableMarkets`)),
                         CONSTRAINT `copyrights` CHECK (json_valid(`copyrights`)),
                         CONSTRAINT `externalIds` CHECK (json_valid(`externalIds`)),
                         CONSTRAINT `externalUrls` CHECK (json_valid(`externalUrls`)),
                         CONSTRAINT `genres` CHECK (json_valid(`genres`)),
                         CONSTRAINT `images` CHECK (json_valid(`images`))
)
    COLLATE='utf8mb3_bin'
    ENGINE=InnoDB
    AUTO_INCREMENT=18
;


CREATE TABLE IF NOT EXISTS `track` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `idSpotify` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb3_bin',
                         `previewUrl` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `href` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb3_bin',
                         `name` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8mb3_bin',
                         `type` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb3_bin',
                         `uri` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb3_bin',
                         `trackNumber` INT(11) NOT NULL DEFAULT '0',
                         `discNumber` INT(11) NOT NULL DEFAULT '0',
                         `durationMs` INT(11) NOT NULL DEFAULT '0',
                         `availableMarkets` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `externalUrls` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `artists` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         PRIMARY KEY (`id`) USING BTREE,
                         CONSTRAINT `artists` CHECK (json_valid(`artists`)),
                         CONSTRAINT `availableMarkets` CHECK (json_valid(`availableMarkets`)),
                         CONSTRAINT `externalUrls` CHECK (json_valid(`externalUrls`))
)
    COLLATE='utf8mb3_bin'
    ENGINE=InnoDB
;