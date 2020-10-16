# Newsletter
## Example code for discussions on application architecture

This repository contains an example of a simple domain model, implemented in PHP.

- It allows `Subscribers` to `signUp()` so they receive a `Newsletter`.
- `Subscribers` can also `optOut()` to stop receiving the `Newsletter`.
- A list of `Subscribers` can be requested.
- a `Newsletter` can be sent to every subscriber that did not `optOut(). 

The purpose of this code is to support discussions on the topics:
- Application architecture
- Domain-driven design concepts
- Hexagonal architecture
- Outside-in TDD, unit testing

Some parts of the infrastructure code are missing; the persistence and delivery mechanisms are incomplete.
