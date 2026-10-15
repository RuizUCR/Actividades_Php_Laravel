# Actividad: Modelo universitario (Laravel)

Curso, Grupo, Docente, Estudiante y Matrícula, con Laravel 12, Eloquent y Pest.

## Diagrama de clases

```mermaid
classDiagram
    direction LR

    class Curso {
        +String codigo
        +String nombre
    }
    class Grupo {
        +int numero
        +String semestre
        +int cupo
    }
    class Docente {
        +String nombre
    }
    class Estudiante {
        +String nombre
    }
    class Matricula {
        +Date fecha
        +Decimal nota_final
    }

    Curso "1" *-- "1..*" Grupo : se ofrece en
    Grupo "*" --> "1" Docente : lo imparte
    Estudiante "1" -- "*" Matricula : realiza
    Grupo "1" -- "*" Matricula : recibe
```

## Tablas resultantes

```mermaid
erDiagram
    CURSOS {
        bigint id PK
        string codigo UK
        string nombre
        timestamp created_at
        timestamp updated_at
    }
    DOCENTES {
        bigint id PK
        string nombre
        timestamp created_at
        timestamp updated_at
    }
    ESTUDIANTES {
        bigint id PK
        string nombre
        timestamp created_at
        timestamp updated_at
    }
    GRUPOS {
        bigint id PK
        bigint curso_id FK
        bigint docente_id FK
        smallint numero
        string semestre
        smallint cupo
        timestamp created_at
        timestamp updated_at
    }
    MATRICULAS {
        bigint estudiante_id PK, FK
        bigint grupo_id PK, FK
        date fecha
        decimal nota_final
    }

    CURSOS ||--|{ GRUPOS : "se ofrece en"
    DOCENTES ||--o{ GRUPOS : "imparte"
    ESTUDIANTES ||--o{ MATRICULAS : "realiza"
    GRUPOS ||--o{ MATRICULAS : "recibe"
```

## Preguntas de control

**¿Qué relación es composición y por qué?**
Curso ◆── Grupo. El grupo no existe sin su curso: `curso_id` es obligatorio y, si se borra el curso, sus grupos se borran con él (`cascadeOnDelete`). Docente y Estudiante existen por sí mismos, por eso sus relaciones son asociaciones simples.

**¿Qué asociación es unidireccional?**
Grupo ──▶ Docente. El grupo conoce a su docente (`belongsTo`), pero el docente no sabe qué grupos tiene, así que `Docente` no tiene método `grupos()`.

**¿Dónde vive la nota?**
En `Matricula`, la clase de asociación entre Estudiante y Grupo. La nota depende del par estudiante-grupo, no de uno solo. En la base de datos es la columna `nota_final` de la tabla `matriculas`.

## Ejecutar el proyecto

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan test
```