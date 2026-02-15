Engineering questions for the Games component


## Engineering Questions
1. Who can 'make' games?
- The publisher is the entity that owns and 'sells' the games. So the Publisher entity is the one owning Game.
2. Who can buy games?
- Users/Players are the ones buying games, which means that **MANY** users can own **MANY** games. Which are never instances of the same game, but still a multiple instance of different games.

## Relationships

1. **One to Many**
- **One** Publisher can **own** many games.
2. **Many to Many**
- **Many** Users can own **one or more(many) games**