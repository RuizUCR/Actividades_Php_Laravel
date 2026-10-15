<?php

class Palabra
{
    public function __construct(public string $texto) {}
}

class Oracion
{
    /** @var Palabra[] */
    private array $palabras = [];

    // Composición: la oración crea sus palabras
    public function agregarPalabra(string $texto): Palabra
    {
        $palabra = new Palabra($texto);
        $this->palabras[] = $palabra;
        return $palabra;
    }

    public function palabras(): array
    {
        return $this->palabras;
    }
}

class Parrafo
{
    /** @var Oracion[] */
    private array $oraciones = [];

    public function agregarOracion(): Oracion
    {
        $oracion = new Oracion();
        $this->oraciones[] = $oracion;
        return $oracion;
    }

    public function oraciones(): array
    {
        return $this->oraciones;
    }
}

class Capitulo
{
    /** @var Parrafo[] */
    private array $parrafos = [];

    public function __construct(public string $titulo) {}

    public function agregarParrafo(): Parrafo
    {
        $parrafo = new Parrafo();
        $this->parrafos[] = $parrafo;
        return $parrafo;
    }

    public function parrafos(): array
    {
        return $this->parrafos;
    }
}

class Libro
{
    /** @var Capitulo[] */
    private array $capitulos = [];

    public function __construct(public string $titulo) {}

    public function agregarCapitulo(string $titulo): Capitulo
    {
        $capitulo = new Capitulo($titulo);
        $this->capitulos[] = $capitulo;
        return $capitulo;
    }

    public function capitulos(): array
    {
        return $this->capitulos;
    }
}

// Prueba
$libro = new Libro('Mi libro');
$cap = $libro->agregarCapitulo('Capítulo 1');
$par = $cap->agregarParrafo();
$ora = $par->agregarOracion();
$ora->agregarPalabra('Hola');
$ora->agregarPalabra('mundo');

echo $libro->titulo . ' tiene ' . count($libro->capitulos()) . " capítulo(s)\n";
echo 'La primera oración tiene ' . count($ora->palabras()) . " palabras\n";