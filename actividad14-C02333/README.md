# Actividad 14

## Ejercicio 4: Receta e ingredientes

Una receta tiene título, porciones e instrucciones, y contiene de uno a muchos ingredientes. De cada ingrediente de la receta se guarda la cantidad y la unidad de medida.

### Diagrama de clases

```mermaid
classDiagram
    direction LR

    class Receta {
        +String titulo
        +int porciones
        +String instrucciones
    }
    class RecetaIngrediente {
        +Decimal cantidad
        +String unidad
    }
    class Ingrediente {
        +String nombre
    }

    Receta "receta 1" *-- "detalles 1..*" RecetaIngrediente : contiene
    RecetaIngrediente "detalles *" --> "ingrediente 1" Ingrediente : usa
```

`RecetaIngrediente` es la clase de asociación: guarda la cantidad y la unidad de cada ingrediente dentro de una receta. Un ingrediente puede aparecer en varias recetas.

### Código
- Instanciación de `Receta`: `new Receta([...])` seguido de `save()`, en `tests/Feature/RecetaTest.php`
- Modelos: `app/Models/Receta.php`, `app/Models/Ingrediente.php`, `app/Models/RecetaIngrediente.php`
- Migraciones: `database/migrations/2026_10_22_00000*_create_*`
- Instanciación de `Receta`: `tests/Feature/RecetaTest.php`

### Diagrama entidad-relación

```mermaid
erDiagram
    RECETAS {
        bigint id PK
        string titulo
        smallint porciones
        text instrucciones
        timestamp created_at
        timestamp updated_at
    }
    INGREDIENTES {
        bigint id PK
        string nombre
        timestamp created_at
        timestamp updated_at
    }
    RECETA_INGREDIENTE {
        bigint receta_id PK, FK
        bigint ingrediente_id PK, FK
        decimal cantidad
        string unidad
    }

    RECETAS ||--|{ RECETA_INGREDIENTE : "contiene"
    INGREDIENTES ||--o{ RECETA_INGREDIENTE : "se usa en"
```

## Ejercicio 5: Propiedades

### Diagrama de clases

```mermaid
classDiagram
    direction TB

    class Persona {
        +String nombre
        +Date fechaNacimiento
    }
    class Vivienda {
        <<abstract>>
        +String direccion
    }
    class Casa {
        +bool tieneJardin
        +bool esIndividual
    }
    class Apartamento {
        +int piso
        +bool tieneAscensor
    }
    class Habitacion {
        +decimal superficie
    }
    class FuncionHabitacion {
        <<enumeration>>
        COCINA
        DORMITORIO
        BANO
        SALA
        OTRA
    }

    Persona "conyuge 0..1" -- "conyuge 0..1" Persona : casado con
    Persona "padres 0..2" -- "hijos 0..*" Persona : tiene
    Persona "habitantes *" --> "vivienda 1" Vivienda : vive en
    Persona "propietario 1" -- "propiedades *" Vivienda : posee
    Vivienda <|-- Casa
    Vivienda <|-- Apartamento
    Vivienda "vivienda 1" *-- "habitaciones 1..*" Habitacion : se compone de
    Habitacion "habitaciones *" --> "funcion 1" FuncionHabitacion : tiene
```
