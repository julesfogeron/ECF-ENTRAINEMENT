-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 jan. 2024 à 14:01
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecf`
--
CREATE DATABASE IF NOT EXISTS `ecf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecf`;
-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
                         `id` int(11) NOT NULL,
                         `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cryptomonnaie`
--

CREATE TABLE `cryptomonnaie` (
                                 `id` int(11) NOT NULL,
                                 `nomCryptomonnaie` int(11) NOT NULL,
                                 `prix` double NOT NULL,
                                 `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cryptomonnaienom`
--

CREATE TABLE `cryptomonnaienom` (
                                    `id` int(11) NOT NULL,
                                    `nomCryptomonnaie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favoris cryptomonnaie`
--

CREATE TABLE `favoris cryptomonnaie` (
                                         `id` int(11) NOT NULL,
                                         `idUser` int(11) NOT NULL,
                                         `cryptomonnaie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `nom` varchar(50) NOT NULL,
                        `dateDeNaissance` date NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `utilisateur` varchar(50) NOT NULL,
                        `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_user_admin` (`idUser`);

--
-- Index pour la table `cryptomonnaie`
--
ALTER TABLE `cryptomonnaie`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idCryptomonnaie` (`nomCryptomonnaie`) USING BTREE;

--
-- Index pour la table `cryptomonnaienom`
--
ALTER TABLE `cryptomonnaienom`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris cryptomonnaie`
--
ALTER TABLE `favoris cryptomonnaie`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_user_fav` (`idUser`),
    ADD KEY `id_cryptomonnaie_fav` (`cryptomonnaie`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cryptomonnaie`
--
ALTER TABLE `cryptomonnaie`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cryptomonnaienom`
--
ALTER TABLE `cryptomonnaienom`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favoris cryptomonnaie`
--
ALTER TABLE `favoris cryptomonnaie`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
    ADD CONSTRAINT `id_user_admin` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cryptomonnaie`
--
ALTER TABLE `cryptomonnaie`
    ADD CONSTRAINT `id_cryptomonnaie_` FOREIGN KEY (`nomCryptomonnaie`) REFERENCES `cryptomonnaienom` (`id`);

--
-- Contraintes pour la table `favoris cryptomonnaie`
--
ALTER TABLE `favoris cryptomonnaie`
    ADD CONSTRAINT `id_cryptomonnaie_fav` FOREIGN KEY (`cryptomonnaie`) REFERENCES `cryptomonnaienom` (`id`),
    ADD CONSTRAINT `id_user_fav` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
