# 📚 laravel-course

> A full Laravel 10 course — from first route to production APIs, Eloquent,
> queues, and testing.
>
> Built from the material I taught as an IT lecturer at **Cao Thắng Technical
> College** (Trường Cao đẳng Kỹ thuật Cao Thắng).

![license](https://img.shields.io/badge/license-MIT-green.svg) ![php](https://img.shields.io/badge/php-8.1+-777BB4.svg) ![laravel](https://img.shields.io/badge/laravel-10-FF2D20.svg) ![lessons](https://img.shields.io/badge/lessons-38-blue.svg) ![topics](https://img.shields.io/badge/topics-24-orange.svg) ![status](https://img.shields.io/badge/status-active-brightgreen.svg)

---

## How this course is organised

- **`lessons/`** — the structured curriculum. Start here and go in order. Each
  lesson covers one concept with notes, a runnable example, and an exercise.
- **`topics/`** — deeper dives into specific areas (Eloquent internals, the
  service container, queues, security, testing, DevOps). Reference these once
  you're comfortable with the basics.

Every lesson and topic is a folder containing a `README.md`, an `examples/`
directory, and an `exercise.php` (or `exercise.md`) so you can read, run, and
practise.

## Requirements

- PHP **8.1+**
- [Composer](https://getcomposer.org/)
- Laravel 10 (`composer create-project laravel/laravel:^10.0 myapp`)

## Curriculum (lessons/)

### Part 1 — Getting started
1. [Setting up Laravel 10](./lessons/01-setup-laravel/)
2. [Project structure](./lessons/02-project-structure/)
3. [The `artisan` CLI](./lessons/03-artisan-cli/)
4. [Your first route & response](./lessons/04-first-route/)
5. [Environment & configuration](./lessons/05-environment-config/)

### Part 2 — Routing & controllers
6. [Routing basics](./lessons/06-routing-basics/)
7. [Route parameters](./lessons/07-route-parameters/)
8. [Named routes & route groups](./lessons/08-named-routes-groups/)
9. [Controllers](./lessons/09-controllers/)
10. [Resource controllers](./lessons/10-resource-controllers/)
11. [Route model binding](./lessons/11-route-model-binding/)

### Part 3 — Requests & responses
12. [The Request object](./lessons/12-request-object/)
13. [Validation](./lessons/13-validation/)
14. [Form Request classes](./lessons/14-form-requests/)
15. [Responses: JSON, redirects, status codes](./lessons/15-responses/)
16. [Middleware](./lessons/16-middleware/)

### Part 4 — Blade & views
17. [Blade basics](./lessons/17-blade-basics/)
18. [Layouts & template inheritance](./lessons/18-blade-layouts/)
19. [Blade components](./lessons/19-blade-components/)
20. [Forms & CSRF](./lessons/20-forms-and-csrf/)
21. [Asset bundling with Vite](./lessons/21-vite-assets/)

### Part 5 — Database & Eloquent
22. [Migrations](./lessons/22-migrations/)
23. [Eloquent model basics](./lessons/23-eloquent-basics/)
24. [Querying with Eloquent](./lessons/24-eloquent-querying/)
25. [One-to-many relationships](./lessons/25-relationships-one-to-many/)
26. [Many-to-many relationships](./lessons/26-relationships-many-to-many/)
27. [Factories & seeders](./lessons/27-factories-seeders/)
28. [The Query Builder](./lessons/28-query-builder/)

### Part 6 — Auth & authorization
29. [Authentication](./lessons/29-authentication/)
30. [Authorization: gates & policies](./lessons/30-authorization-gates-policies/)
31. [Sessions & flash data](./lessons/31-sessions-and-flash/)

### Part 7 — APIs & async
32. [Building a JSON API](./lessons/32-json-apis/)
33. [API resources](./lessons/33-api-resources/)
34. [API tokens with Sanctum](./lessons/34-sanctum-tokens/)
35. [Queues & jobs](./lessons/35-queues-and-jobs/)
36. [Events & listeners](./lessons/36-events-and-listeners/)
37. [Task scheduling](./lessons/37-task-scheduling/)
38. [Testing](./lessons/38-testing/)

## Deep dives (topics/)

Reference these once you're comfortable with the lessons.

### Eloquent & database
- [Relationships, deeper](./topics/eloquent-relationships-deep/) — `hasManyThrough`, polymorphic, `whereHas`
- [Query scopes](./topics/eloquent-scopes/) — local & global scopes
- [Accessors, mutators & casts](./topics/accessors-mutators-casts/)
- [The N+1 problem & eager loading](./topics/eager-loading-n1/)
- [Soft deletes](./topics/soft-deletes/)
- [Database transactions](./topics/database-transactions/)

### Core framework
- [The service container](./topics/service-container/)
- [Service providers](./topics/service-providers/)
- [Facades](./topics/facades/)
- [Collections](./topics/collections/)

### HTTP & security
- [Middleware, deeper](./topics/middleware-deep/) — terminable, params, groups
- [Rate limiting](./topics/rate-limiting/)
- [Custom validation rules](./topics/validation-rules/)
- [CSRF & XSS protection](./topics/csrf-and-xss/)
- [Mass assignment](./topics/mass-assignment/)

### Async & infrastructure
- [Queues, deeper](./topics/queues-deep/) — retries, failed jobs, batching
- [Caching](./topics/caching/)
- [Mail & notifications](./topics/notifications-mail/)
- [Custom artisan commands](./topics/custom-artisan-commands/)

### Testing & quality
- [Pest](./topics/pest/)
- [HTTP tests & fakes](./topics/http-tests-deep/)
- [Database testing](./topics/database-testing/)

### DevOps & patterns
- [Docker & Laravel Sail](./topics/docker-laravel/)
- [Action & service classes](./topics/action-classes-and-services/)

## License

MIT — see [LICENSE](./LICENSE). Use it, fork it, teach with it.
