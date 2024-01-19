CREATE DATABASE IF NOT EXISTS `bd_revision` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_revision`;

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
    `id` int NOT NULL AUTO_INCREMENT,
    `courriel` nvarchar(50) NOT NULL,
    `motDePasse` nvarchar(255) NOT NULL,
    `type` nvarchar(50) NOT NULL DEFAULT 'client',
    PRIMARY KEY (`id`),
    UNIQUE (`courriel`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `demandes_soumission`;
CREATE TABLE `demandes_soumission` (
    `id` int NOT NULL AUTO_INCREMENT,
    `utilisateur_id` int NOT NULL,
    `nom` nvarchar(50) NOT NULL,
    `telephone` nvarchar(12) NOT NULL,
    `ville` nvarchar(255) NOT NULL,
    `niv` nvarchar(17) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `images_demande_soumission`;
CREATE TABLE `images_demande_soumission` (
    `id` int NOT NULL AUTO_INCREMENT,
    `demandes_soumission_id` int NOT NULL,
    `nom` nvarchar(255) NOT NULL,
    `extension` nvarchar(8) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (demandes_soumission_id) REFERENCES demandes_soumission(id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `soumissions`;
CREATE TABLE `soumissions` (
    `id` int NOT NULL AUTO_INCREMENT,
    `demandes_soumission_id` int NOT NULL,
    `vendeur_utilisateurs_id` int NOT NULL,
    `prix` decimal(19, 4) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (demandes_soumission_id) REFERENCES demandes_soumission(id),
    FOREIGN KEY (vendeur_utilisateurs_id) REFERENCES utilisateurs(id)
) ENGINE=InnoDB;