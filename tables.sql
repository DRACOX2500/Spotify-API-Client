CREATE TABLE `artist` (
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

CREATE TABLE `album` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `idSpotify` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `albumGroup` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `albumType` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `artists` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `availableMarkets` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `copyrights` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `externalIds` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `externalUrls` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `genres` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `href` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `images` LONGTEXT NOT NULL COLLATE 'utf8mb3_bin',
                         `label` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `name` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb3_bin',
                         `popularity` INT(11) NULL DEFAULT '0',
                         `releaseDate` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `releaseDatePrecision` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `totalTracks` INT(11) NOT NULL DEFAULT '0',
                         `type` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         `uri` VARCHAR(255) NOT NULL COLLATE 'utf8mb3_bin',
                         PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8mb3_bin'
ENGINE=InnoDB
;