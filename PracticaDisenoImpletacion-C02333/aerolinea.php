<?php

class Aeropuerto
{
    // Unidireccional: no guarda sus vuelos
    public function __construct(
        public string $codigo,
        public string $nombre,
    ) {}
}

class Avion
{
    public ?Aerolinea $aerolinea = null; // bidireccional

    public function __construct(
        public string $matricula,
        public string $modelo,
    ) {}
}

class Vuelo
{
    public ?Aerolinea $aerolinea = null; // bidireccional

    public function __construct(
        public string $numeroVuelo,
        public Avion $avion,
        public Aeropuerto $origen,
        public Aeropuerto $destino,
    ) {}
}

class Aerolinea
{
    /** @var Avion[] */
    private array $aviones = [];
    /** @var Vuelo[] */
    private array $vuelos = [];

    public function __construct(public string $nombre) {}

    public function agregarAvion(Avion $avion): void
    {
        $this->aviones[] = $avion;
        $avion->aerolinea = $this;
    }

    public function agregarVuelo(Vuelo $vuelo): void
    {
        $this->vuelos[] = $vuelo;
        $vuelo->aerolinea = $this;
    }

    public function aviones(): array
    {
        return $this->aviones;
    }

    public function vuelos(): array
    {
        return $this->vuelos;
    }
}

// Instanciación
$aerolinea = new Aerolinea('Aerolíneas CR');

$avion = new Avion('TI-123', 'Airbus A320');
$aerolinea->agregarAvion($avion);

$sjo = new Aeropuerto('SJO', 'Juan Santamaría');
$lir = new Aeropuerto('LIR', 'Daniel Oduber');

$vuelo = new Vuelo('AC-101', $avion, $sjo, $lir);
$aerolinea->agregarVuelo($vuelo);

echo "Vuelo {$vuelo->numeroVuelo}: {$vuelo->origen->codigo} -> {$vuelo->destino->codigo}\n";
echo "Compañía: {$vuelo->aerolinea->nombre}\n";