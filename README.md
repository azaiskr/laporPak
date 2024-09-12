# Project Title: LaporPak.com

## Description
LaporPak.com is a crowdsourcing platform aimed at improving public infrastructure reporting through easy-to-use forms, community verification, and data visualization. Built with Laravel Breeze for quick user authentication and front-end scaffolding.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Contributing](#contributing)
- [Credits](#credits)

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/azaiskr/laporPak.git
   cd LaporPak.com
    ```

2. **Install dependencies**:
* Install PHP dependencies via Composer:
   ```bash
   composer install
   ```
* Install Node.js dependencies:
    ```bash
   npm install
    ```

3. **Environment Setup**:
* Copy the ```.env.example``` to create your own environment file:
   ```bash
   cp .env.example .env
   ```
* Generate the Laravel app key:
   ```bash
   php artisan key:generate
   ```

4. **Database Configuration**:
* Open ```.env``` and set your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
* Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```
4. **Run the Project**:
* Serve the Laravel application.
   ```bash
   php artisan serve
   ```
* Build front-end assets:
   ```bash
   npm run dev
  ```
* Visit http://localhost:8000 in your browser.


## Usage
* Register or Login to the platform to access the reporting system.
* Go to the “Lapor” page to submit a new report with details and media attachments.
* View submitted reports and participate in the community-based verification process via the “Forum” page.

## Features
* Easy Report Submission: Simple form with media attachments (photos/videos) and map integration.
* Community Verification: Users can upvote and help admin validate reports submitted by others.

## Contributing
Contributions are welcome! To get started:

1. Fork this repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes (git commit -am 'Add new feature').
4. Push the branch to GitHub (git push origin feature-name).
5. Create a pull request describing what you’ve changed.


## Credits

Developed by Kelompok 2 of LaporPak.com team during the Hackathon.