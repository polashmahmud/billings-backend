## Install Project
```javascript
git clone git@github.com:polashmahmud/billings-backend.git
```

```javascript
cd billings-backend
```

```javascript
cp .env.example .env
```

**Note:** Update .env file information. Like: database information, 
mail information

```javascript
composer update
```

```javascript
php artisan jwt:secret
```

```javascript
 php artisan migrate:fresh --seed
```

```javascript
 php artisan serve
```