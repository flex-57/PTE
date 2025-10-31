# 🧭 Pôle Technique d’Évaluation – Centre de Réadaptation de Mulhouse

Application interne développée pour le **Pôle Technique d’Évaluation** du Centre de Réadaptation de Mulhouse.  
Elle permet de **rechercher, consulter et organiser l’arborescence des différentes évaluations** du service :  
les **domaines** contiennent des **métiers** et/ou des **ateliers**, eux-mêmes associés à des **critères d’évaluation**.

---

## ⚙️ Stack technique

- **Framework :** [Symfony 7.x](https://symfony.com/)  
- **Langage :** PHP 8.3.6  
- **Base de données :** MySQL 8.3.0 (`pte_db`)  
- **Frontend :** Twig + TailwindCSS  
- **Administration :** [EasyAdmin](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)  
- **Gestion des dépendances :** Composer  
- **Autres outils :** Doctrine ORM, Symfony Console, Fixtures pour jeu d’essai

---

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/flex-57/PTE.git
   cd PTE
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   ```

3. **Créer la base de données**
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

4. **Charger le jeu d’essai (fixtures)**
   ```bash
   php bin/console doctrine:fixtures:load
   ```

5. **Créer un compte administrateur**
   ```bash
   php bin/console app:create-admin
   ```
   (La commande te guidera pour renseigner un email et un mot de passe.)

6. **Lancer le serveur de développement**
   ```bash
   symfony server:start
   ```
   👉 Puis ouvre [http://localhost:8000](http://localhost:8000)

---

## 🧭 Fonctionnalités principales

- 🔍 **Recherche rapide** des éléments (domaines, métiers, ateliers, critères)
- 🌳 **Navigation hiérarchique** entre les différentes entités du service
- 🧩 **Interface d’administration complète** avec EasyAdmin
- 👤 **Authentification sécurisée** avec création d’un compte admin via la console
- 🧠 **Commandes personnalisées Symfony**
  - `app:create-admin` → création d’un premier compte administrateur
- 🧪 **Fixtures incluses** pour disposer d’un jeu de données d’essai complet

---

## 🔐 Authentification

- Le premier compte administrateur est créé via :
  ```bash
  php bin/console app:create-admin
  ```
- Le module de connexion standard Symfony gère ensuite les sessions et la sécurité.

---

## 👨‍💻 Auteur

Développé par **Fabrice Gessa** *(alias [flex-57](https://github.com/flex-57))*  
Projet réalisé pour le **Centre de Réadaptation de Mulhouse**, service du **Pôle Technique d’Évaluation**.  

> “Un projet pratique, conçu pour faciliter l’organisation des évaluations professionnelles du centre.”

---

## 🧾 Licence

Ce projet est un développement interne — usage réservé au Centre de Réadaptation de Mulhouse.  
Toute reproduction ou diffusion sans autorisation est interdite.
