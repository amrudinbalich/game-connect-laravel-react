# User Schema & Roadmap

## 1. User Table
**Purpose:** Core user identity and authentication data.

| Field | Type | Attributes |
| :--- | :--- | :--- |
| `id` | BigInt | Primary Key, Auto Increment |
| `name` | String | |
| `email` | String | Unique |
| `email_verified_at` | Timestamp | Nullable |
| `phone` | String | Unique, Nullable |
| `phone_verified_at` | Timestamp | Nullable |
| `password` | String | Hashed |
| `points_balance` | Integer | Default: 0 (GNP Points) |
| `remember_token` | String | Nullable |
| `created_at` | Timestamp | |
| `updated_at` | Timestamp | |

---

## 2. User Profiles Table
**Purpose:** Extended user information and public-facing profile data.

| Field | Type | Attributes |
| :--- | :--- | :--- |
| `id` | BigInt | Primary Key, Auto Increment |
| `user_id` | ForeignID | FK references `users.id` |
| `profile_name` | String | |
| `real_name` | String | |
| `custom_profile_url`| String | Unique |
| `profile_summary` | Text | |
| `country` | String | |
| `state_province` | String | |
| `city` | String | |

---

## 3. Point Shop (GNP System)
**Concept:** Currency system for profile customizations.

### Conversion Rate
- **1 EUR** = 100 POINTS (GNP)
- **10 EUR** = 1000 GNP’s

### Available Customizations
- [ ] **Profile Backgrounds:** Static or animated backgrounds for the profile page.
- [ ] **Custom Avatars:** Exclusive avatar images.
- [ ] **Custom Frames:** Decorative borders for user avatars.
- [ ] **Profile Level-ups:** Instant XP boost to increase Steam-like profile level.

---

## 4. Privacy Settings
**Purpose:** Controls visibility and accessibility of user profile data.

- `privacy_level` (Public, Friends Only, Private)
- `game_details_visibility`
- `friend_list_visibility`
- `inventory_visibility`
- `comment_visibility`

---

## 5. Roadmap & Topics
- [ ] Email verification implementation
- [ ] Phone verification implementation
- [ ] 2FA Login System (via SMS/Email/Backup codes)
- [ ] User Profile Settings
- [ ] User Profile Comments
- [ ] User Point Shop
