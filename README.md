
It is my plan and note editor in Laravel and vue

Here used Google API, firebase api, elasticsearch, and Redis for cache, 

/post you can see notes, 

/plans you can see plans 

See mockups https://app.moqups.com/Qw8iAhs1JmtaUxlKqtZ4lplhQOOQYNyS/view/page/a8ceb2615

**Demo**

http://stark-savannah-69486.herokuapp.com/

 ****__**To install**__****
1. `git clone`
2. ``cp env.example .env ``
3. `composer install`
4. We need to configure docker-compose with .env
5. `docker-compose up` to start project
6. `php artisan key:generate `
7. `php artisan migrate`
8. Make api keys from google console, firebase console, slack
9. configure `firebase-messaging-sw.js`
10. run `npm run prod`
