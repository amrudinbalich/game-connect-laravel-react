# Users

Core entity representing a registered user in the system.

The `users` table is responsible only for identity and authentication.
All additional behavior (profiles, roles, verification flows, permissions)
is implemented outside of this entity.

---

## Table: users

| Column            | Type            | Notes |
|-------------------|-----------------|-------|
| id                | BIGINT UNSIGNED | Primary key |
| name              | VARCHAR(255)    | User display name |
| email             | VARCHAR(255)    | Unique |
| email_verified_at | TIMESTAMP       | Nullable |
| phone             | VARCHAR(255)    | Unique, nullable |
| phone_verified_at | TIMESTAMP       | Nullable |
| password          | VARCHAR(255)    | Hashed password |
| remember_token    | VARCHAR(100)    | Nullable |
| created_at        | TIMESTAMP       | |
| updated_at        | TIMESTAMP       | |

---

## Possibly supported features

- Follows Publishers
- Region append
- Preferred language

> Note: These features are **planned but not yet implemented**. They are handled outside of this core entity to keep the database clean and modular.