# 📦 Symfony Modular Monolith (DDD Light)

![Symfony](https://img.shields.io/badge/Symfony-000000?style=flat&logo=symfony&logoColor=white)
![Doctrine](https://img.shields.io/badge/Doctrine-ORM-orange)
![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat&logo=php&logoColor=white)

## 🧠 Architektura

Projekt oparty jest o separację **Domain / Application / Infrastructure**.

**Zasada kluczowa:**

> Domain ≠ Infrastructure

Domain jest niezależna od frameworka, bazy danych i technologii zewnętrznych.

## 📁 Struktura projektu

```
src/
├── Shared/
│   ├── Domain/
│   ├── Application/
│   └── Infrastructure/
│
├── Product/
│   ├── Domain/
│   │   ├── Entity/
│   │   ├── Repository/         ---> Interfejsy
│   │   └── ValueObject/
│   │
│   ├── Application/
│   │   ├── Command/
│   │   ├── Query/
│   │   └── Handler/
│   │
│   ├── Infrastructure/
│   │   ├── Repository/         ---> Implementacje
│   │   ├── Service/            
│   │   └── Controller/
│   └── Tests/
│       ├── Unit/
│       ├── Integration/
│       └── Functional/
│
├── Order/
│   ├── Domain/
│   ├── Application/
│   └── Infrastructure/
```

## 🧩 Warstwy

### 🟡 Domain (rdzeń biznesu)

Zawiera:

- encje
- value objects
- interfejsy repozytoriów
- logikę biznesową

❌ NIE zawiera:

- Doctrine
- Symfony
- HTTP
- DB implementacji

### 🔵 Application (use case'y)

Zawiera:

- command / query handlers
- orchestration logiki
- przypadki użycia

Przykład:

```php
final class CreateProductHandler
{
    public function __invoke(CreateProductCommand $command): void
    {
        // logika use-case
    }
}
```

### 🟣 Infrastructure (świat zewnętrzny)

Zawiera:

- Doctrine ORM implementation
- HTTP Controllers
- API clients
- Redis / Messenger / external services

Przykład:

```php
final class DoctrineProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
```

## 🧱 Doctrine ORM

Encje mogą być w:

```
src/Product/Domain/Entity
```

lub:

```
src/Product/Infrastructure/Doctrine/Entity
```

Konfiguracja:

```yaml
doctrine:
  orm:
    mappings:
      Product:
        is_bundle: false
        type: attribute
        dir: '%kernel.project_dir%/src/Product/Domain/Entity'
        prefix: 'App\Product\Domain\Entity'
```

## 📨 Messenger (opcjonalnie)

**Symfony Messenger**

Używany do:

- async jobs
- event handling
- decoupling logic

## 🧪 Validator / Serializer

**Symfony Validator** • **Symfony Serializer**

Stosowane tylko w:

- Application / Infrastructure

Domain nie zależy od nich.

## 🌐 Controller

Kontrolery znajdują się w Infrastructure:

```php
#[Route('/products')]
final class ProductController
{
    public function __invoke(): Response
    {
        return new Response('OK');
    }
}
```

## 🚫 Zasady architektury

❌ **NIE ROBIMY:**

- Doctrine w Domain
- Symfony w Domain
- HTTP w Domain
- DB logic w Domain

✅ **ROBIMY:**

- Domain = czysty PHP
- Infrastructure = framework
- Application = use cases

## 🔁 Dependency Rule

```
Domain → nic
Application → Domain
Infrastructure → Application + Domain
```

## 🧭 Przykład flow

```
HTTP Request
   ↓
Controller (Infrastructure)
   ↓
Command Handler (Application)
   ↓
Domain Model
   ↓
Repository Interface (Domain)
   ↓
Doctrine Implementation (Infrastructure)
```

## 🚀 Cel architektury

- łatwe testowanie
- brak vendor lock-in
- skalowalność
- czytelna struktura
- możliwość podziału na mikroserwisy w przyszłości

## 🧪 Testowanie

- **Domain** → unit tests (pure PHP)
- **Application** → integration tests
- **Infrastructure** → functional tests

## 📌 Podsumowanie

To nie jest "Symfony project structure".

To jest:

> modularny monolit z DDD light + hexagonal architecture
