ForexCashBack
=============

[ForexCashBack](http://www.forexcashback.com)

Setup Instructions
------------------

### Prerequisites
1. [Composer](http://getcomposer.org/)
2. [Bower](http://bower.io/)
3. [Postgres](http://www.postgresql.org/)


### Basic Setup

1. Clone the repository
    > git clone git@github.com:ForexCashBack/forex.git

2. Setup parameters
    > cd forex

    > cp app/config/parameters.yml.dist app/config/parameters.yml

    Tweak as necessary
3. Composer Install
    > composer install

4. Setup database
    > psql -U postgres

    > CREATE USER forex WITH PASSWORD 'forex';

    > CREATE DATABASE forex;
    
    > GRANT ALL PRIVILEGES ON DATABASE forex to forex;
    
    > \q
5. Run the migrations
    > app/console doctrine:migrations:migrate

6. Install all of our web component via bower
    > bower install

7. Give it a test run
    > app/console server:run 127.0.0.1:8080

    Open your browser to http://localhost:8080
