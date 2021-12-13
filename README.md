## BASKET TOTAL

## Project set up

1) Clone project from repo
   ``https://github.com/computools/acme``


2) run composer ``composer install``


3) run tests ``./vendor/bin/phpunit``





## Remarks
I used libraries like illuminate/collections to easily interact with a list of products (not use arrays) and moneyphp/money to properly count amounts.
I used to keep my data in collection, for the time economy purpose and to focus more on business logic.
OfferService keep factory inside and returns needed offer type processor.

In this app I developed mostly business logics, this means that in real project I'll add validation of incoming parameters and exception processing.

Also, I think that basket shouldn't depend on product catalogue.     