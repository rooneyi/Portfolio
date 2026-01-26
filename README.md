# Rooney.tech

Rooney.tech est mon portfolio de développeur, construit avec Symfony et les outils de l’écosystème moderne (Webpack Encore/Tailwind, Stimulus, etc.). Il présente mes projets, mon parcours et les différentes compétences que je mets en avant.

## 🚀 Objectifs du projet

- Présenter mon travail et mes réalisations de manière professionnelle.
- Centraliser mes projets (personnels, professionnels, open source…).
- Offrir un point d’entrée simple pour me contacter.
- Servir de terrain d’expérimentation pour tester de nouvelles technos et bonnes pratiques.

## 🧰 Stack technique

- **Back-end** : Symfony (PHP)
- **Front-end** : Webpack Encore, Tailwind CSS (config via `symfonycasts_tailwind`), Stimulus
- **Base de données** : Doctrine ORM
- **Tests** : PHPUnit

## 📁 Structure du projet

- `assets/` : sources front (JS, CSS, Stimulus, icônes…)
- `config/` : configuration Symfony (framework, sécurité, doctrine, etc.)
- `migrations/` : migrations de base de données
- `public/` : racine web (index.php, assets compilés…)
- `src/` : code applicatif Symfony (controllers, entities, repositories…)
- `templates/` : vues Twig (pages, composants, layout…)
- `tests/` : tests automatiques

## ⚙️ Installation & lancement

1. Cloner le dépôt :

   ```bash
   git clone <URL_DU_DEPOT>
   cd Rooney.tech
   ```

2. Installer les dépendances PHP :

   ```bash
   composer install
   ```

3. Installer les dépendances front (si nécessaire) :

   ```bash
   npm install
   ```

4. Configurer ton fichier d’environnement :

   ```bash
   cp .env .env.local
   # puis adapter les variables (BDD, mailer, etc.)
   ```

5. Lancer les migrations :

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. Lancer le serveur de dev Symfony :

   ```bash
   symfony serve -d
   ```

7. (Optionnel) Compiler les assets :

   ```bash
   npm run dev
   ```

## 🌐 Accès au portfolio

Une fois le serveur lancé, le portfolio est accessible à l’adresse :

- http://127.0.0.1:8000 (ou l’URL fournie par `symfony serve`)

C’est ici que je présente mes projets et mon profil de développeur.

## 📬 Me contacter

Tu peux me contacter via :

- Le formulaire de contact présent sur le site (si disponible)
- Les liens externes (GitHub, LinkedIn, email…) présents dans l’interface du portfolio

## 📝 À propos

Ce dépôt correspond à **mon portfolio personnel**, utilisé pour montrer mon travail, expérimenter de nouvelles idées et maintenir une présence technique en ligne. N’hésite pas à t’en inspirer, mais évite de le copier tel quel pour ton propre portfolio 😉.
# Portfolio
# Portfolio
# Portfolio
# Portfolio
