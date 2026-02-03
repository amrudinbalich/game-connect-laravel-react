# Publisher

Core entity representing a game publisher in the system.

The `publishers` table stores all relevant information about companies responsible for publishing games.  
This entity is **standalone** and does not imply ownership by any user in the system.

---

## Table: publishers

| Column      | Type            | Notes |
|------------|----------------|-------|
| id         | BIGINT UNSIGNED | Primary key |
| name       | VARCHAR(255)    | Publisher name |
| about      | TEXT            | Nullable, description or company info |
| website_url| VARCHAR(255)    | Nullable, official website |
| created_at | TIMESTAMP       | |
| updated_at | TIMESTAMP       | |

---

## Possibly supported features

- Follower list  
- Company Logo  
- Company News Feed  
- Company Region

> Note: These features are **planned but not yet implemented**. They are handled outside of this core entity to keep the database clean and modular.
