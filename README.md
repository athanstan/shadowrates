<p align="center"><img src="https://en.shadowverse-evolve.com/wordpress/wp-content/themes/en-shadowverse-evolve/assets/images/common/logo.png" alt="Shadowverse Logo"></p>

# ShadowRates

ShadowRates is a comprehensive companion app for Shadowverse players, designed to help track, rate, and analyze cards from the popular digital card game. Whether you're a competitive player looking to stay on top of the meta or a casual player exploring new decks, ShadowRates provides the tools you need to enhance your Shadowverse experience.

## About Shadowverse

Shadowverse is a free-to-play digital collectible card game developed by Cygames. Known for its strategic gameplay, diverse craft classes, and beautiful artwork, Shadowverse has attracted millions of players worldwide. The game features regular expansions, adding new cards and mechanics that keep the gameplay experience fresh and engaging.

## Features

-   **Comprehensive Card Database**: Browse and search through all cards from the latest expansions.
-   **Card Rating System**: Rate cards based on their performance in various formats and view community ratings.
-   **Coming Soon**:
    -   Deck Building: Create, save, and share your favorite decks.
    -   Meta Analysis: Track the most popular and successful decks in the current meta.

## Tech Stack

-   **Frontend**: Laravel Blade, Livewire, Tailwind CSS
-   **Backend**: Laravel, PHP
-   **Database**: PostgreSQL
-   **Containerization**: Docker (Laravel Sail)

## Getting Started

### Prerequisites

-   Docker and Docker Compose
-   Composer
-   Git

### Installation

1. Clone the repository:

    ```
    git clone https://github.com/yourusername/shadowrates.git
    cd shadowrates
    ```

2. Install dependencies:

    ```
    composer install
    ```

3. Copy the environment file and configure it:

    ```
    cp .env.example .env
    ```

4. Start the application using Laravel Sail:

    ```
    ./vendor/bin/sail up -d
    ```

5. Generate application key:

    ```
    ./vendor/bin/sail artisan key:generate
    ```

6. Run migrations:

    ```
    ./vendor/bin/sail artisan migrate
    ```

7. Seed the database with card data:
    ```
    ./vendor/bin/sail artisan db:seed
    ```

### Usage

1. Browse cards by set, craft, or type
2. Rate cards and read community reviews
3. Create and save decks (coming soon)

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

-   Cygames for creating Shadowverse
-   The Shadowverse community for their passion and support

## Disclaimer

ShadowRates is not affiliated with, endorsed, or sponsored by Cygames. All card images, game mechanics, and related Shadowverse content are property of Cygames.
