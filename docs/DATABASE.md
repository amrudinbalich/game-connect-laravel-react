# Database Overview

This document describes the logical data model and database-level rules.
The database is considered a core consistency boundary of the system.

## Design Principles
- Relational integrity is enforced at the database level
- Business-critical constraints are not handled exclusively in application code
- Historical data is preserved where applicable
