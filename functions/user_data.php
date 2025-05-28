<?php
class user_data {
    public ?int $id_participante;
    public string $usuario;
    public string $password;
    public string $nombre;
    public string $apellidos;
    public string $email;
    public string $baja;

    public function __construct(array $user = ['id_participante' => null, 'usuario' => 'usuario', 'password' => '12345','nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email', 'baja' => 0]) {
        $this->id_participante = $user['id_participante'];
        $this->usuario = $user['usuario'];
        $this->password = $user['password'];
        $this->nombre = $user['nombre'];
        $this->apellidos = $user['apellidos'];
        $this->email = $user['email'];
        $this->baja = $user['baja'];
    }
}
?>