# Note
- This SQL script (vand.sql) contains sample data intended for testing purposes
- You can access the API documentation at http://[your-domain-local]/documentation.
- If you have any questions or require assistance with running these tests, please feel free to reach out to me at [thuyngtrong@gmail.com].

# Database Structure

This database, named `vand`, is designed to manage user authentication, stores, products, and user tokens for your application. Let's break down each table's purpose and structure:

## Table: `users`

- The `users` table stores information about users in your application.
- `id`: An auto-incremented unique identifier for each user.
- `name`: The user's name.
- `email`: The user's email address. It's unique to ensure each user has a distinct email.
- `password`: The user's hashed password.
- `firstName`: The user's first name.
- `lastName`: The user's last name.
- `since`: The date and time when the user account was created.
- `lastUpdate`: The date and time of the last update to the user's information.
- **Primary Key**: `id`
- **Unique Constraint**: `email`

## Table: `stores`

- The `stores` table is used to store information about stores in your application.
- `id`: An auto-incremented unique identifier for each store.
- `userId`: A foreign key referencing the `id` in the `users` table, indicating which user owns the store.
- `name`: The name of the store.
- `description`: A brief description of the store.
- `since`: The date and time when the store was created.
- `lastUpdate`: The date and time of the last update to the store's information.
- **Primary Key**: `id`
- **Foreign Key**: `userId` references `users(Id)`
- **Index**: `name`

## Table: `products`

- The `products` table is responsible for managing product information.
- `id`: An auto-incremented unique identifier for each product.
- `storeId`: A foreign key referencing the `id` in the `stores` table, indicating which store the product belongs to.
- `name`: The name of the product.
- `description`: A brief description of the product.
- `price`: The price of the product with two decimal places.
- `quantity`: The quantity of the product available.
- `userId`: A foreign key referencing the `id` in the `users` table, indicating which user added the product.
- `since`: The date and time when the product was added.
- `lastUpdate`: The date and time of the last update to the product's information.
- **Primary Key**: `id`
- **Foreign Key**: `userId` references `users(Id)`
- **Foreign Key**: `storeId` references `stores(Id)`
- **Index**: `name`

## Table: `tokens`

- The `tokens` table stores access and refresh tokens for user authentication.
- `id`: An auto-incremented unique identifier for each token.
- `userID`: A foreign key referencing the `id` in the `users` table, indicating which user the token belongs to.
- `tokenType`: An enumeration ('access' or 'refresh') specifying the type of token.
- `tokenValue`: The actual token value, which is unique to ensure token uniqueness.
- `expiryDate`: The date and time when the token expires.
- **Primary Key**: `id`
- **Unique Constraint**: `tokenValue`
- **Index**: `userID`, `tokenType`, `tokenValue`

This database schema provides the foundation for managing users, stores, products, and user tokens in your application. It allows you to securely authenticate users and manage their data effectively.
